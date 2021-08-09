@component('mail::message')
<h1>@lang('email/common.hello'), {{$data->company->name}}</h1>

<br>
@lang('email/subscription.greetings')

@component('mail::table')
|||||||
|-|-| :- | -: | -: | -:|
|||||||
||| <strong>@lang('company/payment.success.invoice_number')</strong> |{{$data->payment_invoice}}||
||| <strong>@lang('company/payment.success.invoice_date')</strong> |{{$data->date_invoice}} |
||| <strong>@lang('company/payment.success.type')</strong> | {{$data->subscription_type}} ({{$data->period_type}})||
||| <strong>@lang('company/payment.success.quotas')</strong> |@if ($data->respond_quota == -1)
No Limit
@endif
@if ($data->respond_quota > -1)
{{$data->respond_quota}}
@endif||
||| <strong>@lang('company/payment.success.amount')</strong> | $ {{$data->amount}}||
||| <strong>@lang('company/payment.success.date_payment')</strong> | {{$data->date_payment}} ||
||| <strong>@lang('company/payment.success.end_date')</strong> | {{$data->ending_period}} ||
@endcomponent
@component('mail::panel')

<strong>@lang('company/membership.title') :</strong>
<ul>
  <li>@lang('company/membership.items.0')</li>
  <li>@lang('company/membership.items.1')</li>
  <li>@lang('company/membership.items.2')</li>
</ul>
@endcomponent

@lang('email/common.thanks_for_premium')
<br>
<br>
@lang('email/common.best_regards')
<br>
<br>
{{ config('app.name') }}

@slot('subcopy')

<a href="{{ config('app.url') }}/term-of-use">@lang('email/common.term_conditions')</a> <a href="{{ config('app.url') }}/privacy-policy">@lang('email/common.privacy')</a> <a href="{{ config('app.url') }}/contact">@lang('email/common.contact_us')</a>
@endslot
@endcomponent
