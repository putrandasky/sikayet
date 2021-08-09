@extends('layouts.website')


@section('content')
<div class="container w-100 h-100  d-flex  align-items-center">

  <div class="row w-100 justify-content-center ">
    <div class="col-md-6">
      <div class="card w-100">
        <div class="card-title text-center mt-3">
          <div class="mb-2"><i class="fa fa-check fa-3x text-light bg-success rounded-circle p-2"></i></div>
          <p class="h3">@lang('company/payment.success.title')</p>
        </div>
        <div class="card-body ">
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.invoice_number')
            </div>
            <div>
              {{$membership_paid->payment_invoice}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.invoice_date')
            </div>
            <div>
              {{$membership_paid->date_invoice}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.company_name')
            </div>
            <div>
              {{$company->name}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.type')
            </div>
            <div>
              {{$membership_paid->subscription_type}} ({{$membership_paid->period_type}})
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.quotas')
            </div>
            <div>
              @if ($membership_paid->respond_quota == -1)
              @lang('company/payment.success.no_limit')
              @endif
              @if ($membership_paid->respond_quota > -1)
              {{$membership_paid->respond_quota}}
              @endif

            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.amount')
            </div>
            <div>
              $ {{$membership_paid->amount}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.date_payment')
            </div>
            <div>
              {{$membership_paid->date_payment}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              @lang('company/payment.success.end_date')
            </div>
            <div>
              {{$membership_paid->ending_period}}
            </div>
          </div>

          <a class="btn btn-primary btn-block mt-3" href="/company-dashboard"> @lang('company/payment.success.back')
</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
