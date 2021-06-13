<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function getPrivacyPolicy()
    {
        $data = Models\Editor::key('privacy-policy')->value;
        return $data;
    }
    public function composePrivacyPolicy(Request $request)
    {
        $data = Models\Editor::key('privacy-policy');
        $data->value = $request->data;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Privacy Policy Updated'], 200);
    }
    public function getTermOfUse()
    {
        $data = Models\Editor::key('term-of-use')->value;
        return $data;
    }
    public function composeTermOfUse(Request $request)
    {
        $data = Models\Editor::key('term-of-use');
        $data->value = $request->data;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Term of Use Updated'], 200);
    }
    public function getAgreement()
    {
        $data = Models\Editor::key('agreement')->value;
        return $data;
    }
    public function composeAgreement(Request $request)
    {
        $data = Models\Editor::key('agreement');
        $data->value = $request->data;
        $data->save();
        return response()->json(['status' => 'success', 'message' => 'Contract Updated'], 200);
    }
    public function composeAbout(Request $request)
    {
        $items = $request->data;
        foreach ($items as $item => $value) {
            $data = Models\Editor::key($item);
            $data->value = $value;
            $data->save();
        }
        return response()->json(['status' => 'success', 'message' => 'About Updated'], 200);

    }
    public function getAbout(Request $request)
    {
        $data = Models\Editor::where('key', 'like', "about_%")->get();
        return $data;

    }
}
