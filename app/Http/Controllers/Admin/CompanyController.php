<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index($condition)
    {

        $data['account_statuses'] = Models\AccountStatus::get();

        if ($condition == 'unactive') {
            $companies = Models\Company::hasStatus(1)->latest()->with('account_status')->get();
        }
        if ($condition == 'regular') {
            $companies = Models\Company::hasStatus(2)->latest()->with('account_status')->where('membership_id', 0)->get();
        }
        if ($condition == 'premium') {
            $companies = Models\Company::hasStatus(2)->latest()->with('account_status')->where('membership_id', '!=', 0)->get();
        }
        if ($condition == 'suspended') {
            $companies = Models\Company::hasStatus(3)->latest()->with('account_status')->get();
        }
        $data['companies'] = $companies;
        return $data;
    }
    public function update(Request $request, $company_id)
    {
        $company = Models\Company::id($company_id)->first();
        $company->account_status_id = $request->account_status_id;
        $company->is_verified = $request->is_verified;
        $company->save();
        return response()->json(['status' => 'success', 'message' => 'Company data updated'], 200);
    }
}
