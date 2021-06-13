<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;

class FaqController extends Controller
{
    public function showFaq()
    {
        $data = Models\EditorFaqGroup::with('editor_faqs')->get();
        return view('pages.home-faq', compact("data"));

    }
}
