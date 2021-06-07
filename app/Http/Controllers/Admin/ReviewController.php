<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($condition)
    {

        $data['review_statuses'] = Models\ReviewStatus::get();

        if ($condition == 'new') {
            $reviews = Models\Review::hasStatus(1)->withBelongings()->latest()->get();
        }
        if ($condition == 'reported') {
            $reviews = Models\Review::hasStatus(2)->withBelongings()->latest()->where('reported', '>', 0)->get();
        }
        if ($condition == 'suspended') {
            $reviews = Models\Review::hasStatus(3)->withBelongings()->latest()->get();
        }
        $data['reviews'] = $reviews;
        return $data;

    }
    public function update(Request $request, $review_id)
    {
        $review = Models\Review::id($review_id)->first();
        $company = Models\Company::id($review->company_id)->first();
        $user = Models\User::id($review->user_id)->first();
        $review->review_status_id = $request->review_status_id;
        if (!isset($review->published_at)) {
            $review->published_at = Carbon\Carbon::now();
            $user->review += 1;
            $company->review += 1;
            $company["star_{$review->rating}"] += 1;
            if ($review->review_type_id == 1) {
                $company->review_general += 1;
            }
            if ($review->review_type_id == 2) {
                $company->review_solution += 1;
            }
            if ($review->review_type_id == 3) {
                $company->review_complaint += 1;
            }

            $user->save();
            $company->save();
            $total_star_count = $company->star_1 + $company->star_2 + $company->star_3 + $company->star_4 + $company->star_5;
            $rating = (($company->star_1 * 1) + ($company->star_2 * 2) + ($company->star_3 * 3) + ($company->star_4 * 4) + ($company->star_5 * 5) + $review->rating) / ($total_star_count + 1);
            $company->rating = $rating;
            $company->save();
        }
        $review->save();
        return response()->json(['status' => 'success', 'message' => 'Review data updated'], 200);
    }
}
