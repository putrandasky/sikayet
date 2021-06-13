<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class MembershipInfoController extends Controller
{
    public function getMembershipInfo()
    {
        $data = Models\EditorMembershipInfo::get();
        return $data;
    }
    public function composeMembershipInfo(Request $request)
    {
        $store = new Models\EditorMembershipInfo();
        $store->title = $request->title;
        $store->description = $request->description;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'Membership Info Stored', 'data' => $store->id], 200);
    }
    public function updateMembershipInfo(Request $request, $memebership_info_id)
    {
        $store = Models\EditorMembershipInfo::where('id', $memebership_info_id)->first();
        $store->title = $request->title;
        $store->description = $request->description;
        $store->save();
        return response()->json(['status' => 'success', 'message' => 'Membership Info Stored', 'data' => $store->id], 200);
    }
    public function deleteMembershipInfo($memebership_info_id)
    {
        $data = Models\EditorMembershipInfo::find($memebership_info_id);
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'Membership Info Deleted'], 200);
    }
}
