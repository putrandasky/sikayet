<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;

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
}
