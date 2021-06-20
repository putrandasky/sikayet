<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models;
use App\Traits\CompanyMembershipHandler;
use Auth;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    use CompanyMembershipHandler;

    public function showCurrentMembership()
    {
        $company = Auth::guard('company')->user();
        $current_membership = Models\MembershipActive::where('company_id', $company->id)->first();

        return $current_membership;
    }
    public function indexBillingHistory()
    {
        $company = Auth::guard('company')->user();
        $histories = Models\MembershipHistory::where([
            'company_id' => $company->id,
        ])->latest()
            ->get();

        return $histories;

    }

    public function buyMembership(Request $request, $period)
    {
        $company = Auth::guard('company')->user();

        // $membership_plan = Models\MembershipPlan::where('id', $request->id)->first();
        $current_membership = Models\MembershipActive::where('company_id', $company->id)->first();
        // $now = Carbon::now();

        // $membership_history = new Models\MembershipHistory();
        // $membership_history->date_payment = Carbon::now();
        // $membership_history->ending_period = $period == 'annualy' ? $now->addYears(1) : ($period == 'monthly' ? $now->addMonths(1) : 0);
        // $membership_history->subscription_type = $membership_plan->subscription_type;
        // $membership_history->period_type = $period;
        // $membership_history->payment_method = 'CREDIT CARD';
        // $membership_history->respond_quota = $membership_plan->respond_quota;
        // $membership_history->company_id = $company->id;
        // $membership_history->status = 1;
        // $membership_history->amount = $period == 'annualy' ? $membership_plan->annual_price : ($period == 'monthly' ? $membership_plan->monthly_price : 0);
        // $membership_history->save();

        $get_current_package = $this->getCurrentPackage($company->id);
        if ($period == 'annualy' && $membership_plan->respond_quota != -1) {
            # code...
            $this->storedReservedRespondQuota($membership_history);
        }
        $this->updateMembershipActive($current_membership, $get_current_package, $company->id);
        // if ($current_membership) {

        //     $current_ending_period = Carbon::parse($current_membership->ending_period);
        //     $current_quota = $current_membership->respond_quota;
        //     $current_membership->date_payment = $get_current_package->date_payment;
        //     $current_membership->ending_period = $get_current_package->ending_period;
        //     $current_membership->subscription_type = $get_current_package->subscription_type;
        //     $current_membership->period_type = $get_current_package->period_type;
        //     $current_membership->payment_method = 'CREDIT CARD';
        //     $current_membership->save();

        // } else {

        //     $current_membership = new Models\MembershipActive();
        //     $current_membership->date_payment = $get_current_package->date_payment;
        //     $current_membership->ending_period = $get_current_package->ending_period;
        //     $current_membership->subscription_type = $get_current_package->subscription_type;
        //     $current_membership->period_type = $get_current_package->period_type;
        //     $current_membership->payment_method = 'CREDIT CARD';
        //     $current_membership->company_id = $company->id;
        //     $current_membership->save();

        // }
        $company->respond_quota = $membership_plan->respond_quota == -1 ? $company->respond_quota : $company->respond_quota + $membership_plan->respond_quota;

        $company->respond_unlimited = $get_current_package->respond_quota == -1 ? 1 : 0;
        $company->save();
        return response()->json(['status' => 'status', 'message' => 'message', 'data' => $company->respond_quota], 200);

    }
    public function membershipInfo()
    {
        $info = Models\EditorMembershipInfo::get();
        return $info;
    }

}
