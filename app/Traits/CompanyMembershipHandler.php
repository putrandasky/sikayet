<?php
namespace App\Traits;

use App\Models;
use Carbon\Carbon;
trait CompanyMembershipHandler
{
    public function checkReservedQuota($company_id)
    {

        $current_reserved_quotas = Models\ReservedMembershipRespondQuota::where([
            'company_id' => $company_id,
            'is_released' => 0,
        ])->where('plan_release_date', '<', Carbon::now());
        if (!$current_reserved_quotas->exists()) {
            return;
        }
        $current_reserved_quotas = $current_reserved_quotas->orderBy('plan_release_date')->get();
        foreach ($current_reserved_quotas as $current_reserved_quota) {
            $company = Models\Company::id($company_id)->first();
            $reserved_quota = Models\ReservedMembershipRespondQuota::where('id', $current_reserved_quota->id)->first();
            $company->respond_quota += $reserved_quota->respond_quota;
            $company->save();
            $reserved_quota->is_released = 1;
            $reserved_quota->save();
        }
    }

    public function checkMembershipStatus($company_id)
    {
        $histories = Models\MembershipHistory::where([
            'company_id' => $company_id,
            'status' => 1,
        ])->where('ending_period', '<', Carbon::now());
        if (!$histories->exists()) {
            return;
        }

        $histories = $histories->orderBy('ending_period')->get();
        foreach ($histories as $history) {
            $membership_history = Models\MembershipHistory::where('id', $history->id)->first();
            $membership_history->status = 0;
            $membership_history->save();
        }
    }
    public function updateMembershipActive($current_membership, $get_current_package, $company_id)
    {
        if ($current_membership) {

            $current_ending_period = Carbon::parse($current_membership->ending_period);
            $current_quota = $current_membership->respond_quota;
            $current_membership->date_payment = $get_current_package->date_payment;
            $current_membership->ending_period = $get_current_package->ending_period;
            $current_membership->subscription_type = $get_current_package->subscription_type;
            $current_membership->period_type = $get_current_package->period_type;
            $current_membership->payment_method = $get_current_package->payment_method;
            // $current_membership->respond_unlimited = $membership_plan->respond_quota == -1 ? 1 : 0;
            // $current_membership->respond_quota = $membership_plan->respond_quota == -1 ? $current_quota : $current_quota + $membership_plan->respond_quota;
            $current_membership->save();

        } else {

            $current_membership = new Models\MembershipActive();
            $current_membership->date_payment = $get_current_package->date_payment;
            $current_membership->ending_period = $get_current_package->ending_period;
            $current_membership->subscription_type = $get_current_package->subscription_type;
            $current_membership->period_type = $get_current_package->period_type;
            $current_membership->payment_method = $get_current_package->payment_method;
            // $current_membership->respond_quota = $membership_plan->respond_quota == -1 ? 0 : $membership_plan->respond_quota;
            // $current_membership->respond_unlimited = $membership_plan->respond_quota == -1 ? 1 : 0;
            $current_membership->company_id = $company_id;
            $current_membership->save();

        }

    }
    public function getCurrentPackage($company_id)
    {
        $histories = Models\MembershipHistory::where([
            'company_id' => $company_id,
            'status' => 1,
            'respond_quota' => -1,
        ])->orderBy('ending_period')->first();

        if ($histories) {
            return $histories;
        }
        if (!$histories) {
            $histories = Models\MembershipHistory::where([
                'company_id' => $company_id,
                'status' => 1,
            ])->where('respond_quota', '>', 0)->get();
            $period_histories = array();
            $max_quota_histories = array();
            for ($i = 0; $i < count($histories); $i++) {
                if ($histories[$i]['period_type'] == 'yearly') {
                    array_push($period_histories, $histories[$i]);
                }
            }
            for ($i = 0; $i < count($histories); $i++) {
                if ($histories[$i]['period_type'] == 'monthly') {
                    if ($i == 0) {
                        $period_histories = array();
                    }
                    array_push($period_histories, $histories[$i]);
                }
            }
            for ($i = 0; $i < count($period_histories); $i++) {
                if ($i == 0) {
                    array_push($max_quota_histories, $period_histories[$i]);
                }
                if ($i > 0) {
                    $length = count($max_quota_histories) - 1;
                    if ($max_quota_histories[$length]['respond_quota'] == $period_histories[$i]['respond_quota']) {
                        array_push($max_quota_histories, $period_histories[$i]);
                    }
                    if ($max_quota_histories[$length]['respond_quota'] < $period_histories[$i]['respond_quota']) {
                        $max_quota_histories = array();
                        array_push($max_quota_histories, $period_histories[$i]);
                    }
                }

            }
            return collect($max_quota_histories)->sortBy('ending_period')->first();
        }

    }
}
