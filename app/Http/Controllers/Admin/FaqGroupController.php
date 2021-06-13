<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class FaqGroupController extends Controller
{
    public function getFaqGroup()
    {
        $data = Models\EditorFaqGroup::with('editor_faqs')->get();
        return $data;
    }
    public function composeFaqGroup(Request $request)
    {
        $store = new Models\EditorFaqGroup();
        $store->name = $request->name;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'FAQ Group Stored', 'data' => $store->id], 200);
    }
    public function updateFaqGroup(Request $request, $faq_group_id)
    {
        $store = Models\EditorFaqGroup::where('id', $faq_group_id)->first();
        $store->name = $request->name;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'FAQ Group Stored', 'data' => $store->id], 200);
    }
    public function deleteFaqGroup($faq_group_id)
    {
        $data = Models\EditorFaqGroup::find($faq_group_id);
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'FAQ Group Deleted'], 200);
    }
}
