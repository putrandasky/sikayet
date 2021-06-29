@component('mail::message')
<h1>Hello, {{$data->company->name}}</h1>

<br>
You already purchased a subscription for premium membership package as below

@component('mail::table')
|||||||
|-|-| :- | -: | -: | -:|
|||||||
||| <strong>Invoice Number</strong> |{{$data->payment_invoice}}||
||| <strong>Invoice Date</strong> |{{$data->date_invoice}} |
||| <strong>Subscription type</strong> | {{$data->subscription_type}} ({{$data->period_type}})||
||| <strong>Respond Quotas</strong> |@if ($data->respond_quota == -1)
No Limit
@endif
@if ($data->respond_quota > -1)
{{$data->respond_quota}}
@endif||
||| <strong>Amount</strong> | $ {{$data->amount}}||
||| <strong>Date Payment</strong> | {{$data->date_payment}} ||
||| <strong>End Date Package</strong> | {{$data->ending_period}} ||
@endcomponent
@component('mail::panel')

<strong>Previlage of being premium membership :</strong>
<ul>
  <li>Able to respond user review to your brand</li>
  <li>No Ads on your company page</li>
  <li>Receive email notification while user submit a review for your brand</li>
</ul>
@endcomponent

Thank you for join us with premium membership.
<br>
<br>
Best Regards
<br>
<br>
{{ config('app.name') }}

@slot('subcopy')

  <a href="{{ config('app.url') }}/term-of-use">Term Condition</a> <a href="{{ config('app.url') }}/privacy-policy">Privacy Policy</a> <a href="{{ config('app.url') }}/contact">Contact Us</a>
@endslot
@endcomponent
