<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models;

class SocialController extends Controller
{
    public function facebook()
    {
        $data = Models\Editor::where('key', 'social_facebook')->first();
        if (strlen($data->value) > 0) {
            return redirect()->to($data->value);
        }
        return redirect('/');
    }
    public function twitter()
    {
        $data = Models\Editor::where('key', 'social_twitter')->first();
        if (strlen($data->value) > 0) {
            return redirect()->to($data->value);
        }
        return redirect('/');
    }
    public function instagram()
    {
        $data = Models\Editor::where('key', 'social_instagram')->first();
        if (strlen($data->value) > 0) {
            return redirect()->to($data->value);
        }
        return redirect('/');
    }
    public function linkedin()
    {
        $data = Models\Editor::where('key', 'social_linkedin')->first();
        if (strlen($data->value) > 0) {
            return redirect()->to($data->value);
        }
        return redirect('/');
    }
}
