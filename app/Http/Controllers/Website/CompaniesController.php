<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {

        $data = Models\Company::where('name', 'like', "%{$request->input('name')}%")->orderBy('review', 'DESC')->orderBy('rating', 'DESC')->select(['id', 'name', 'profile', 'review', 'slug', 'rating']);
        $count = $data->count();
        $companies = $data->paginate(10);
        return view('pages.companies', compact("companies", "count"));

    }
}
