<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models;
use App\Traits\CompanyMembershipHandler;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Str;
use Stripe;
use URL;

class PaymentController extends Controller
{
    use CompanyMembershipHandler;
    public function checkoutPaypal(Request $request)
    {
        $clientId = "AX5BLj5Fg4F6KpMnUinPLlBZiEHYoRrsfBiyRsOaeUemPouWpQTv-JXL12TG6g0UZsh5wbuXTpQiz1od";
        $clientSecret = "EHaIcGJkleFbkYfjVdNaI9syvJoP8zhGynBeyjbm1a7ENA3VtL-7gdg93nTieaLiozck_8DJFLOCofoi";
        $company = Auth::guard('company')->user();

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);
        $order_request = new OrdersCreateRequest();
        $session_id = Str::random(40);
        $product_name = $this->productName($request);
        $order_request->prefer('return=representation');
        $order_request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $session_id,
                "description" => $product_name,
                "amount" => [
                    "value" => $request->period == 'annualy' ? $request->item['annual_price'] : $request->item['monthly_price'],
                    "currency_code" => "USD",
                ],
                // "items" => [
                //     "name" => $product_name,
                //     "unit_amount" => [
                //         "value" => $request->period == "annualy" ? $request->item["annual_price"] * 100 : $request->item["monthly_price"] * 100,
                //     ],
                //     "quantity" => "1",
                // ],
            ]],
            "application_context" => [
                "cancel_url" => URL::to('/') . "/checkout/payment-cancel?session_id={$session_id}",
                "return_url" => URL::to('/') . "/checkout/payment-success?session_id={$session_id}",
            ],
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($order_request);
            $this->storeBillingHistory($request, $company, $session_id, 'PayPal');

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return response()->json(['status' => 'success', 'message' => 'Paypal Link Created', 'data' => $response], 200);
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

    }
    public function checkout(Request $request)
    {
        $company = Auth::guard('company')->user();
        $stripe = new Stripe\StripeClient(
            'sk_test_4eC39HqLyjWDarjtT1zdp7dc'
        );
        $session_id = Str::random(40);

        $product_name = $this->productName($request);
        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $request->period == 'annualy' ? $request->item['annual_price'] * 100 : $request->item['monthly_price'] * 100,
                    'product_data' => [
                        'name' => $product_name,
                        // 'images' => ["https://i.imgur.com/EHyR2nP.png"],
                    ],
                ],
                // 'name' => $product_name,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => request()->url() . "/payment-success?session_id={$session_id}",
            'cancel_url' => request()->url() . "/payment-cancel?session_id={$session_id}",
        ]);
        $this->storeBillingHistory($request, $company, $session_id, 'Card');
        return response()->json(['status' => 'success', 'message' => 'Stripe Link Created', 'id' => $checkout_session->id], 200);
    }

    public function productName($request)
    {
        return 'Subscription ' . $request->item['subscription_type'] . ' (' . $request->period . ') ';

    }

    public function storeBillingHistory($request, $company, $session_id, $paymentMethod)
    {
        $membership_plan = Models\MembershipPlan::where('id', $request->item['id'])->first();

        $now = Carbon::now();

        $membership_history = new Models\MembershipHistory();
        $membership_history->date_invoice = Carbon::now();
        $membership_history->payment_invoice = $this->generateInvoiceNumber($company);
        $membership_history->ending_period = $request->period == 'annualy' ? $now->addYears(1) : ($request->period == 'monthly' ? $now->addMonths(1) : 0);
        $membership_history->subscription_type = $membership_plan->subscription_type;
        $membership_history->period_type = $request->period;
        $membership_history->payment_method = $paymentMethod;
        $membership_history->respond_quota = $membership_plan->respond_quota;
        $membership_history->session_id = $session_id;
        $membership_history->company_id = $company->id;
        $membership_history->payment_status = 'UNPAID';
        $membership_history->status = 0;
        $membership_history->amount = $request->period == 'annualy' ? $membership_plan->annual_price : ($request->period == 'monthly' ? $membership_plan->monthly_price : 0);
        $membership_history->save();

    }
    public function paymentSuccess(Request $request)
    {
        $session_id = $request->input('session_id');
        $membership_paid = Models\MembershipHistory::where([
            'status' => 0,
            'payment_status' => 'UNPAID',
            'session_id' => $session_id])->first();
        if (!$membership_paid) {
            return view('pages.404');
        }
        $membership_paid->date_payment = Carbon::now();
        $membership_paid->payment_status = 'PAID';
        $membership_paid->status = 1;
        $membership_paid->save();
        $company = Models\Company::id($membership_paid->company_id)->first();

        $current_membership = Models\MembershipActive::where('company_id', $company->id)->first();

        $get_current_package = $this->getCurrentPackage($company->id);
        if ($membership_paid->period_type == 'annualy' && $membership_paid->respond_quota != -1) {
            $this->storedReservedRespondQuota($membership_paid);
        }

        $this->updateMembershipActive($current_membership, $get_current_package, $company->id);
        $company->respond_quota = $membership_paid->respond_quota == -1 ? $company->respond_quota : $company->respond_quota + $membership_paid->respond_quota;
        $company->respond_unlimited = $get_current_package->respond_quota == -1 ? 1 : 0;
        $company->save();
        // return view('pages.payment-success');
        return view('pages.payment-success', compact('company', 'membership_paid'));
    }
    public function generateInvoiceNumber($company)
    {
        $count_history = Models\MembershipHistory::companyId($company->id)->count() + 1;
        $timestamp = Carbon::now()->timestamp;
        return (string) $company->id . (string) $timestamp . (string) $count_history;

    }
    public function storedReservedRespondQuota($membership_history)
    {

        for ($i = 0; $i < 11; $i++) {
            $store = Models\ReservedMembershipRespondQuota::create([
                'plan_release_date' => Carbon::now()->addMonths($i + 1),
                'is_released' => 0,
                'respond_quota' => $membership_history->respond_quota,
                'membership_history_id' => $membership_history->id,
                'company_id' => $membership_history->company_id,
            ]);
        }
    }
    public function pay(Request $request)
    {
        $stripe = new Stripe\StripeClient(
            'sk_test_51J0g2kAgrRxk9jofcwUhzrYVm8I5xji5Ozku3dqRiHuQxCZTj1VVShJ54aN4gb63zy801N3y0GorPqlEAOkCw4hv00XFOpojJI'
        );
        $paymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $request->formData['cardNumberNotMask'],
                'exp_month' => $request->formData['cardMonth'],
                'exp_year' => $request->formData['cardYear'],
                'cvc' => $request->formData['cardCvv'],
            ],
        ]);

        $data = $stripe->paymentIntents->create([
            'amount' => $request->period == 'annualy' ? $request->item['annual_price'] * 100 : $request->item['monthly_price'] * 100,
            'currency' => 'usd',
            'payment_method' => $paymentMethod,
            'confirm' => true,
            'payment_method_types' => ['card'],
            'receipt_email' => 'radityo.putra@gmail.com',

        ]);
        return $data;
    }
}
