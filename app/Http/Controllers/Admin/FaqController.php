<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function getFaq()
    {
        $data = Models\EditorFaq::get();
        return $data;
    }
    public function composeFaq(Request $request)
    {
        $store = new Models\EditorFaq();
        $store->question = $request->question;
        $store->answer = $request->answer;
        $store->editor_faq_group_id = $request->group_id;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'FAQ Stored', 'data' => $store->id], 200);
    }
    public function updateFaq(Request $request, $faq_id)
    {
        $store = Models\EditorFaq::where('id', $faq_id)->first();
        $store->question = $request->question;
        $store->answer = $request->answer;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'FAQ Stored', 'data' => $store->id], 200);
    }
    public function deleteFaq($faq_id)
    {
        $data = Models\EditorFaq::find($faq_id);
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'FAQ Deleted'], 200);
    }
}
