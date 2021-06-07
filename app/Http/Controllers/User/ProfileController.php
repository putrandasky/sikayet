<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $user = Auth::guard('web')->user();
        // $review = Models\Review::userId($user->id)
        return view('pages.user-dashboard', compact('user'));

    }
}
