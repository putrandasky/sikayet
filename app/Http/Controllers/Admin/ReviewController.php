<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class ReviewController extends Controller
{
    public function index($condition)
    {

        $data['review_statuses'] = Models\ReviewStatus::get();

        if ($condition == 'new') {
            $reviews = Models\Review::hasStatus(1)->withBelongings()->latestUpdate()->get();
        }
        if ($condition == 'reported') {
            $reviews = Models\Review::hasStatus(2)->withBelongings()->latestUpdate()->where('reported', '>', 0)->get();
        }
        if ($condition == 'suspended') {
            $reviews = Models\Review::hasStatus(3)->withBelongings()->latestUpdate()->get();
        }
        if ($condition == 'orphans') {

            $reviews['business_categories'] = Models\BusinessCategory::get();
            $reviews['data'] = Models\ReviewOrphan::withBelongings()->latest()->get();
        }
        $data['reviews'] = $reviews;
        return $data;

    }
    public function update(Request $request, $review_id)
    {
        $review = Models\Review::id($review_id)->first();

        //scenario for review to be "PUBLISHED" and not have published data
        if (!isset($review->published_at) && $request->review_status_id == 2) {
            $this->incrementReviewData($review_id, $request->rating);
            $review->published_at = Carbon\Carbon::now();
            $review->suspended_at = null;
            $review->save();
        }
        //scenario for review to be "SUSPENDED" and not have published data (which means from "IN REVIEW" status)

        if (!isset($review->published_at) && $request->review_status_id == 3) {
            $review->published_at = null;
            $review->suspended_at = Carbon\Carbon::now();
            $review->save();
        }
//scenario for review to be "SUSPENDED" and have published data (which means from published status)
        if (isset($review->published_at) && $request->review_status_id == 3) {
            $this->decrementReviewData($review_id);
            $review->published_at = null;
            $review->suspended_at = Carbon\Carbon::now();
            $review->save();
        }
        $review->review_status_id = $request->review_status_id;
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->description = $request->description;
        $review->save();

        return response()->json(['status' => 'success', 'message' => 'Review data updated'], 200);
    }

    public function registerCompanyByReviewOrphan(Request $request)
    {
        $this->validator($request->new_company)->validate();

        $company = $this->create($request->new_company);

        if ($company) {

            $review_orphan = Models\ReviewOrphan::id($request->id)->first();

            $review = new Models\Review();
            $review->rating = $review_orphan->rating;
            $review->title = $review_orphan->title;
            $review->description = $review_orphan->description;
            $review->review_type_id = $review_orphan->review_type_id;
            $review->photo = $review_orphan->photo;
            $review->review_status_id = 2;
            $review->company_id = $company->id;
            $review->accept_tnc = 'accepted';
            $review->user_id = $review_orphan->user_id;
            $review->published_at = Carbon\Carbon::now();

            $review->save();
            $review->slug = md5($review->id . $review->user_id . $review->company_id);
            $review->save();
            $review_orphan->review_status_id = 2;
            $review_orphan->save();
            $this->incrementReviewData($review->id);

            if ($review->id) {
                return response()->json(['status' => 'success', 'message' => 'New Company Created and Review Stored'], 200);
            }
        }

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'business_category' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Models\Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'business_category_id' => $data['business_category'],
            'account_status_id' => 1,
            'is_verified' => 1,
            'slug' => Str::slug($data['name'], '-'),
            'password' => Hash::make($data['password']),

        ]);
    }
    public function incrementReviewData($review_id, $user_rating)
    {
        $review = Models\Review::id($review_id)->first();
        $company = Models\Company::id($review->company_id)->first();
        $user = Models\User::id($review->user_id)->first();
        $user->review += 1;
        $company->review += 1;
        $company["star_{$user_rating}"] += 1;
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
}
