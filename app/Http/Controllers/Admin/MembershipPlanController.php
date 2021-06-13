<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plan = Models\MembershipPlan::get();
        return $plan;
    }

    public function store(Request $request)
    {

        $store = Models\MembershipPlan::create([
            'icon' => $request->icon,
            'subscription_type' => $request->subscription_type,
            'subscription_subtitle' => $request->subscription_subtitle,
            'respond_quota' => $request->respond_quota,
            'monthly_price' => $request->monthly_price,
            'annual_price' => $request->annual_price,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Successfully Stored', 'data' => $store], 200);
    }
    public function update(Request $request)
    {

        $update = Models\MembershipPlan::where('id', $request->id)->update([
            'icon' => $request->icon,
            'subscription_type' => $request->subscription_type,
            'subscription_subtitle' => $request->subscription_subtitle,
            'respond_quota' => $request->respond_quota,
            'monthly_price' => $request->monthly_price,
            'annual_price' => $request->annual_price,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Successfully updated'], 200);
    }
    public function delete($membership_id)
    {
        $data = Models\MembershipPlan::find($membership_id);
        $data->delete();
        return response()->json(['status' => 'success', 'message' => 'Successfully deleted'], 200);
    }
}
