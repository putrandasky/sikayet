<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $user = $this->user();
        $data['reviews'] = Models\Review::userId($user->id)->with([
            'company' => function ($query) {
                $query->select(['id', 'name', 'avatar']);
            },
            'company_respond',
            'review_type',
            'review_status'])->latest()->get();
        $data['review_types'] = Models\ReviewType::get();

        // $review = Models\Review::userId($user->id)
        return $data;

    }
    public function update(Request $request, $review_id)
    {
        $review = Models\Review::id($review_id)->first();
        // if ($review->review_status_id == 2) {
        //     return response()->json(['status' => 'error', 'message' => 'Your review already in PUBLISHED'], 403);
        // }

        $review->title = $request->title;
        $review->description = $request->description;
        $review->rating = $request->rating;
        $review->review_type_id = $request['review_type']['id'];
        $review->review_status_id = 1;
        $review->save();
        return response()->json(['status' => 'success', 'message' => 'Your Review Updated'], 200);

    }
    public function delete($review_id)
    {
        $review = Models\Review::id($review_id)->first();
        $user = $this->user();
        $user->like -= $review->like;
        $user->dislike -= $review->dislike;
        $user->save();

        $review_feedbacks = Models\ReviewFeedback::where('review_id', $review->id)->get();
        if ($review_feedbacks) {
            foreach ($review_feedbacks as $feedback) {
                $feedback->delete();
            }
        }
        $company_responds = Models\CompanyRespond::where('review_id', $review->id)->get();
        if ($company_responds) {
            foreach ($company_responds as $respond) {
                $respond->delete();
            }
        }

        if ($review->review_status_id == 2 || ($review->review_status_id == 1 && $review->published_at)) {
            $this->decrementReviewData($review->id);
        }

        $review->delete();
        return response()->json(['status' => 'success', 'message' => 'Your Review Deleted'], 200);

    }
    public function decrementReviewData($review_id)
    {
        $review = Models\Review::id($review_id)->first();
        $company = Models\Company::id($review->company_id)->first();
        $user = Models\User::id($review->user_id)->first();
        $user->review -= 1;
        $company->review -= 1;
        $company["star_{$review->rating}"] -= 1;
        if ($review->review_type_id == 1) {
            $company->review_general -= 1;
        }
        if ($review->review_type_id == 2) {
            $company->review_solution -= 1;
        }
        if ($review->review_type_id == 3) {
            $company->review_complaint -= 1;
        }
        $user->save();
        $company->save();
        $total_star_count = $company->star_1 + $company->star_2 + $company->star_3 + $company->star_4 + $company->star_5;
        $rating = (($company->star_1 * 1) + ($company->star_2 * 2) + ($company->star_3 * 3) + ($company->star_4 * 4) + ($company->star_5 * 5) - $review->rating) / ($total_star_count - 1);
        $company->rating = $rating;
        $company->save();

    }
    public function user()
    {
        return Auth::guard('web')->user();
    }
}
