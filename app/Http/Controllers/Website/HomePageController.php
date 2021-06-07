<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function show()
    {

        $data['header']['title'] = Models\Editor::key('header-title');
        $data['header']['subtitle'] = Models\Editor::key('header-subtitle');
        $data['top-company'] = Models\Company::where('rating', '>', 4)->orderBy('rating')->orderBy('review')->get(['id', 'name', 'profile', 'rating', 'review', 'slug'])->take(5);
        // return $data;
        return view('pages.home', compact("data"));

    }
    public function search(Request $request)
    {
        return Models\Company::where('name', 'like', "%{$request->input('name')}%")->orderBy('rating')->orderBy('review')->get(['id', 'name', 'slug', 'rating'])->take(5);
    }
}
