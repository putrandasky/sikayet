@extends('layouts.website')


@section('content')
<div class="container w-100 h-100  d-flex  align-items-center">

  <div class="row w-100 justify-content-center ">
    <div class="col-md-6">
      <div class="card w-100">
        <div class="card-title text-center mt-3">
          <div class="mb-2"><i class="fa fa-check fa-3x text-light bg-success rounded-circle p-2"></i></div>
          <p class="h3">Payment Success</p>
        </div>
        <div class="card-body ">
          <div class="d-flex justify-content-between">
            <div>
              Invoice Number
            </div>
            <div>
              {{$membership_paid->payment_invoice}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Invoice Date
            </div>
            <div>
              {{$membership_paid->date_invoice}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Company name
            </div>
            <div>
              {{$company->name}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Subsription type
            </div>
            <div>
              {{$membership_paid->subscription_type}} ({{$membership_paid->period_type}})
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Respond Quotas
            </div>
            <div>
              @if ($membership_paid->respond_quota == -1)
              No Limit
              @endif
              @if ($membership_paid->respond_quota > -1)
              {{$membership_paid->respond_quota}}
              @endif

            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Amount
            </div>
            <div>
              $ {{$membership_paid->amount}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              Date Payment
            </div>
            <div>
              {{$membership_paid->date_payment}}
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              End Date Package
            </div>
            <div>
              {{$membership_paid->ending_period}}
            </div>
          </div>

          <a class="btn btn-primary btn-block mt-3" href="/company-dashboard">Back to Dashboard</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
