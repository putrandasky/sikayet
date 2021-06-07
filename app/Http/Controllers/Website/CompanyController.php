<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Illuminate\Http\Request;

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
        $term = Models\Editor::key('term');
        $reviewed = Models\Review::where([
            'user_id' => Auth::guard('web')->user()->id,
            'company_id' => $company->id,
        ])->first();
        $review_type = Models\ReviewType::all();
        return view('pages.user-write-review', compact("company", "review_type", "term", "reviewed"));
    }
    public function review(Request $request, $company_id)
    {
        $review = new Models\Review();
        $review->rating = $request->rating;
        $review->title = $request->title;
        $review->description = $request->description;
        $review->review_type_id = $request->review_type_id;
        $review->review_status_id = 1;
        $review->company_id = $request->company_id;
        $review->accept_tnc = $request->accept_tnc;
        $review->user_id = Auth::guard('web')->user()->id;
        $review->save();
        if ($review->id) {
            return response()->json(['status' => 'success', 'message' => 'Review Stored'], 200);
        }

    }
}
