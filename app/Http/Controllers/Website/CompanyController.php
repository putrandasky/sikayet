<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use App\Notifications\NewReviewSubmited;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use ImageResize;

class CompanyController extends Controller
{
    public function show(Request $request, $company_name)
    {
        //to modified with company is active or not suspended
        $company = Models\Company::where('slug', $company_name)->with([
            'business_category'])->first();
        $this->countVisitorOnCompanyPage($company->id);
        $company = Models\Company::where('slug', $company_name)->with([
            'business_category',
            'membership_active' => function ($query) {
                $query->select('id', 'company_id');
            },
        ])->first();

        $order = 'DESC';
        $rating = null;
        $keyword = null;
        if (isset($request->query()['order_by'])) {
            $order = $request->query()['order_by'] == 'latest' ? 'DESC' : 'ASC';
        }
        if (isset($request->query()['rating'])) {
            $rating = $request->query()['rating'];
        }
        if (isset($request->query()['keyword'])) {
            $keyword = $request->query()['keyword'];
        }

        // $rating = $request->query()['rating'] ?? null;
        // return $rating;

        $reviews = Models\Review::companyId($company->id);

        $rating ? $reviews->where('rating', $rating) : '';
        $keyword ? $reviews->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
        }) : '';
        $reviews = $reviews->where('review_status_id', 2)->orderBy('created_at', $order)->with([
            'user' => function ($query) {
                $query->select(['id', 'name', 'avatar', 'slug', 'review', 'like', 'dislike']);
            },
            'company_respond',
            'review_type',
        ])->paginate(5);
        // return $reviews;
        $common_words = $this->getCommonWords($company_name);
        $keywords = implode(", ", $common_words);
        return view('pages.company-detail', compact("company", "reviews", "common_words", "keywords"));
    }
    public function showReviewForm($company_name)
    {
        //to modified with company is active or not suspended
        $company = Models\Company::where('slug', $company_name)->with('business_category')->first();
        $term = Models\Editor::key('term-of-use')->value;
        $reviewed = Models\Review::where([
            'user_id' => Auth::guard('web')->user()->id,
            'company_id' => $company->id,
        ])->first();
        $review_type = Models\ReviewType::all();
        return view('pages.user-write-review', compact("company", "review_type", "term", "reviewed"));
    }
    public function showReviewAnyCompanyForm()
    {
        $term = Models\Editor::key('term-of-use')->value;

        $review_type = Models\ReviewType::all();
        return view('pages.user-write-review-anycompany', compact("review_type", "term"));
    }
    public function reviewAnyCompany(Request $request)
    {
        $item = json_decode($request->input('itemInput'), true);
        $review = new Models\ReviewOrphan();
        $review->rating = $item['rating'];
        $review->title = $item['title'];
        $review->description = $item['description'];
        $review->review_type_id = $item['review_type_id'];
        $review->review_status_id = 1;
        $review->company_name = $item['company_name'];
        $review->accept_tnc = $item['accept_tnc'];
        $review->user_id = Auth::guard('web')->user()->id;
        if ($request->hasfile('itemFile')) {
            $path = storage_path('app/public/reviewasset');
            File::exists($path) or File::makeDirectory($path);
            $img = ImageResize::make($request->file('itemFile'));
            $hashName = $request->file('itemFile')->hashName();
            $img->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $hashName);
            $review->photo = $hashName;
        }
        $review->save();

        if ($review->id) {
            return response()->json(['status' => 'success', 'message' => 'Review Stored'], 200);
        }

    }
    public function review(Request $request, $company_id)
    {
        $item = json_decode($request->input('itemInput'), true);
        $review = new Models\Review();
        $review->rating = $item['rating'];
        $review->title = $item['title'];
        $review->description = $item['description'];
        $review->review_type_id = $item['review_type_id'];
        $review->review_status_id = 1;

        $review->company_id = $item['company_id'];
        $review->accept_tnc = $item['accept_tnc'];
        $review->user_id = Auth::guard('web')->user()->id;
        if ($request->hasfile('itemFile')) {
            $path = storage_path('app/public/reviewasset');
            File::exists($path) or File::makeDirectory($path);
            $img = ImageResize::make($request->file('itemFile'));
            $hashName = $request->file('itemFile')->hashName();
            $img->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $hashName);
            $review->photo = $hashName;
        }
        $review->save();
        $review->slug = md5($review->id . $review->user_id . $review->company_id);
        $review->save();

        if ($review->id) {
            $company = Models\Company::id($review->company_id)->first();
            $review_data = Models\Review::id($review->id)->withBelongings()->first();
            $company->notify(new NewReviewSubmited($review_data));
            return response()->json(['status' => 'success', 'message' => 'Review Stored'], 200);
        }

    }
    public function giveReviewAction(Request $request)
    {
        $user = $this->user();
        $action = $request->action;
        $review_id = $request->review_id;
        $get_review_action = Models\ReviewFeedback::findBy([$user->id, $review_id])->first();
        if ($get_review_action) {
            return response()->json(['status' => 'error', 'message' => 'You already give response for this review'], 403);
        }
        $review_action = new Models\ReviewFeedback();
        $review_action->is_like = $action == "like" ? 1 : 0;
        $review_action->user_id = $user->id;
        $review_action->review_id = $review_id;
        $review_action->save();

        $review = Models\Review::id($review_id)->first();
        $review_owner = Models\User::id($review->user_id)->first();
        if ($action == 'like') {
            $review->like += 1;
            $review->save();
            $review_owner->like += 1;
            $review_owner->save();
        }
        if ($action == 'dislike') {
            $review->dislike += 1;
            $review->save();
            $review_owner->dislike += 1;
            $review_owner->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Succesfuly give response for this review'], 200);

    }
    public function getCommonWords($slug)
    {
        $company = Models\Company::slug($slug)->with([
            'reviews' => function ($query) {
                $query->where('review_status_id', 2);
            }])->first();
        $keywords = '';
        foreach ($company->reviews as $review) {
            $keywords .= $review->title . ' ' . $review->description;
        }
        $keywords = strtolower(str_replace('.', ' ', trim($keywords)));
        // $keywords =
        $text = $keywords;
        // return $text;
        //Setup the array for storing word counts
        $freqData = array();
        foreach (str_word_count($text, 1) as $words) {
            // For each word found in the frequency table, increment its value by one
            array_key_exists($words, $freqData) ? $freqData[$words]++ : $freqData[$words] = 1;
        }

        $list = '';
        arsort($freqData);
        foreach ($freqData as $word => $count) {
            if ($count > 2 && strlen($word) > 2) {
                $list .= "$word ";
            }
        }
        if (empty($list)) {
            $list = "";
        }
        // echo $list;

        $array_list = array_filter(explode(" ", $list));
        return $array_list;
    }
    public function user()
    {
        return Auth::guard('web')->user();
    }

    public function countVisitorOnCompanyPage($company_id)
    {
        $yesterday = Carbon::now()->subDays(1);
        $has_visited_today = Models\CompanyVisitor::where([
            'ip_address' => request()->ip(),
            'company_id' => $company_id,
        ])->where('last_visit', '>', $yesterday)->first();
        if ($has_visited_today) {
            return false;
        }
        $visitor = Models\CompanyVisitor::create([
            'ip_address' => request()->ip(),
            'company_id' => $company_id,
            'last_visit' => Carbon::now(),
        ]);
        $company = Models\Company::id($company_id)->first();
        $company->visited += 1;
        $company->save();
        return true;

    }
}
