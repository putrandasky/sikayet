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
            $companies = Models\Company::hasStatus(1)->latest()->get();
        }
        if ($condition == 'regular') {
            $companies = Models\Company::hasStatus(2)->hasMembershipActive(false)->latest()->get();
        }
        if ($condition == 'premium') {
            $companies = Models\Company::hasStatus(2)->hasMembershipActive(true)->latest()->get();
        }
        if ($condition == 'suspended') {
            $companies = Models\Company::hasStatus(3)->latest()->get();
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
