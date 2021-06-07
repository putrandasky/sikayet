<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models;
use Auth;

class ProfileController extends Controller
{
    public function show()
    {

        $company = Auth::guard('company')->user();
        $data['review']['total'] = Models\Review::companyId($company->id)->count();
        $data['review']['answered'] = Models\CompanyRespond::companyId($company->id)->count();

        $data['review']['unanswered'] = $data['review']['total'] - $data['review']['answered'];

        $data['company'] = Models\Company::where('id', $company->id)->with('business_category')->first();

        // return $data;
        return view('pages.company-dashboard', compact("data"));

    }
}
