<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;

class DashboardController extends Controller
{
    public function show()
    {
        $data['summary']['user'] = Models\User::count();
        $data['summary']['company'] = Models\Company::count();
        $data['summary']['review'] = Models\Review::count();
        $data['recent']['review'] = Models\Review::withBelongings()->latest()->first();
        $data['recent']['company_registered'] = Models\Company::with('business_category')->latest()->first();
        $data['top']['company_rating'] = Models\Company::where('rating', '>', 4)->where('review', '>', 10)
            ->orderBy('rating', 'DESC')
            ->orderBy('review', 'DESC')
            ->select(['id', 'avatar', 'name', 'profile', 'rating', 'review', 'slug', 'business_category_id', 'slug'])->with('business_category')->get()->take(5);
        $data['top']['company_review'] = Models\Company::select(['id', 'business_category_id', 'name', 'rating', 'review', 'avatar', 'slug'])->with('business_category')->orderBy('review', 'DESC')->get()->take(5);
        $data['top']['user_review'] = Models\User::select(['id', 'created_at', 'like', 'name', 'review', 'avatar', 'slug'])->orderBy('review', 'DESC')->get()->take(5);
        return $data;

    }
}
