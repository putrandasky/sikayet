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
        $user = Auth::guard('web')->user();
        $review = Models\Review::userId($user->id)->with([
            'company' => function ($query) {
                $query->select(['id', 'name']);
            },
            'review_type',
            'review_status'])->latest()->get();
        // $review = Models\Review::userId($user->id)
        return $review;

    }
    public function update(Request $request, $review_id)
    {
        $review = Models\Review::id($review_id)->first();
        $review->title = $request->title;
        $review->description = $request->description;
        $review->rating = $request->rating;
        $review->review_status_id = 1;
        $review->save();
        return response()->json(['status' => 'success', 'message' => 'Your Review Updated'], 200);

    }
}
