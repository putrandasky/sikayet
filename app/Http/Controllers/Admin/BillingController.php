<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index($condition)
    {

        if ($condition == 'paid') {
            $companies = Models\MembershipHistory::paid()->with('company')->latest()->get();
        }
        if ($condition == 'unpaid') {
            $companies = Models\MembershipHistory::unpaid()->with('company')->latest()->get();
        }

        $data['billings'] = $companies;
        return $data;
    }
    public function update(Request $request, $billing_id)
    {
        $company = Models\MembershipHistory::id($billing_id)->first();
        $company->payment_status = $request->payment_status;
        $company->status = $request->status;
        $company->save();
        return response()->json(['status' => 'success', 'message' => 'Billing data updated'], 200);
    }
}
