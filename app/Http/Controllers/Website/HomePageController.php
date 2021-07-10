<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function show()
    {

        $data['header']['title'] = Models\Editor::key('header_title')->value;
        $data['header']['subtitle'] = Models\Editor::key('header_subtitle')->value;

        // return $data;
        return view('pages.home', compact("data"));

    }
    public function getTopCompany($step)
    {
        $limit = 10;
        $offset = $limit * $step;
        $take = $limit * ($step + 1);
        $data = Models\Company::where('rating', '>', 4)->where('review', '>', 10)
            ->orderBy('rating', 'DESC')
            ->orderBy('review', 'DESC')
            ->get(['id', 'avatar', 'name', 'profile', 'rating', 'review', 'slug'])->skip($offset)->take($take);
        return $data;

    }
    public function showTermOfUse()
    {
        $text = Models\Editor::key('term-of-use')->value;
        return view('pages.home-term-of-use', compact("text"));
    }
    public function showAbout()
    {
        $text = Models\Editor::where('key', 'like', "about_%")->get();
        return view('pages.about', compact("text"));
    }
    public function showPrivacyPolicy()
    {
        $text = Models\Editor::key('privacy-policy')->value;
        return view('pages.home-privacy-policy', compact("text"));
    }
    public function showAgreement()
    {
        $text = Models\Editor::key('agreement')->value;
        return view('pages.home-agreement', compact("text"));
    }
    public function showContact()
    {
        return view('pages.home-contact');
    }
    public function postContact(Request $request)
    {
        $store = new Models\Contact();
        $store->name = $request->name;
        $store->email = $request->email;
        $store->message = $request->message;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'Your message has been submitted succesfuly'], 200);
    }
    public function search(Request $request)
    {
        return Models\Company::where('name', 'like', "%{$request->input('name')}%")->orderBy('rating')->orderBy('review')->get(['id', 'name', 'slug', 'rating'])->take(5);
    }
}
