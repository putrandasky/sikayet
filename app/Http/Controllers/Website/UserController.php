<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Carbon\Carbon;

class UserController extends Controller
{
    public function show($slug)
    {
        $user = Models\User::slug($slug)->first();
        $reviews = Models\Review::userId($user->id)->where('review_status_id', 2)->with([
            'company' => function ($query) {
                $query->select(['id', 'name', 'avatar', 'slug']);
            },
            'company_respond',
            'review_type'])->latest()->paginate(5);
        return view('pages.user-detail', compact("user", "reviews"));

    }
    public function showReview($slug)
    {
        $review = Models\Review::slug($slug)->where('review_status_id', 2)->with([
            'company' => function ($query) {
                $query->select(['id', 'name', 'avatar', 'slug']);
            },
            'user' => function ($query) {
                $query->select(['id', 'name', 'avatar', 'slug', 'review', 'like', 'dislike']);
            },
            'company_respond',
            'review_type'])->first();
        $this->countVisitorOnReviewPage($review->id);
        return view('pages.review-detail', compact("review"));

    }
    public function countVisitorOnReviewPage($review_id)
    {
        $yesterday = Carbon::now()->subDays(1);
        $has_visited_today = Models\ReviewVisitor::where([
            'ip_address' => request()->ip(),
            'review_id' => $review_id,
        ])->where('last_visit', '>', $yesterday)->first();
        if ($has_visited_today) {
            return false;
        }
        $visitor = Models\ReviewVisitor::create([
            'ip_address' => request()->ip(),
            'review_id' => $review_id,
            'last_visit' => Carbon::now(),
        ]);
        $review = Models\Review::id($review_id)->first();
        $review->visited += 1;
        $review->save();
        return true;

    }
}
