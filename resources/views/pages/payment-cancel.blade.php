@extends('layouts.website')


@section('content')
<div class="container w-100 h-100  d-flex  align-items-center">

  <div class="row w-100 justify-content-center ">
    <div class="col-md-6">
      <div class="card w-100">
        <div class="card-title text-center mt-3">
          <div class="mb-2"><i style="width:60px; height:auto" class="fa fa-exclamation fa-3x text-dark bg-warning rounded-circle p-2"></i></div>
          <p class="h3">@lang('company/payment.cancel.title')</p>
        </div>
        <div class="card-body ">
          <p>@lang('company/payment.cancel.description')</p>

          <a class="btn btn-primary btn-block mt-3" href="/company-dashboard">@lang('company/payment.cancel.back')d</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
