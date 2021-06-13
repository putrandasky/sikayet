<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use File;
use Illuminate\Http\Request;
use ImageResize;

class CompanyController extends Controller
{
    public function show(Request $request, $company_name)
    {
        //to modified with company is active or not suspended
        $order = 'DESC';
        $rating = null;
        if (isset($request->query()['order_by'])) {
            $order = $request->query()['order_by'] == 'latest' ? 'DESC' : 'ASC';
        }
        if (isset($request->query()['rating'])) {
            $rating = $request->query()['rating'];
        }

        // $rating = $request->query()['rating'] ?? null;
        // return $rating;

        $company = Models\Company::where('slug', $company_name)->with([
            'business_category'])->first();
        $reviews = Models\Review::companyId($company->id);

        $rating ? $reviews->where('rating', $rating) : '';
        $reviews = $reviews->where('review_status_id', 2)->orderBy('created_at', $order)->with([
            'user' => function ($query) {
                $query->select(['id', 'name', 'avatar']);
            },
            'company_respond',
            'review_type',
        ])->paginate(5);
        // return $reviews;
        return view('pages.company-detail', compact("company", "reviews"));
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

        if ($review->id) {
            return response()->json(['status' => 'success', 'message' => 'Review Stored'], 200);
        }

    }
}
