@extends('layouts.website')


@section('content')
<x-base-plain>
  @slot('image')
  company-login.jpg
  @endslot
  <div class="h-100 position-relative">
    <div id="login-form" class="text-center position-absolute bg-white h-100 px-3" style="right:0">
      <div class=" py-3 border-bottom">
   <a href="/">
     <img class="img-fluid" style="max-height:30px" src="/images/logo-large.png" alt="application logo"></img>
   </a>
  </div>
      <div class="mt-3">
        <h4>@lang('company/auth.view.business_account_forgot_password')</h4>
      </div>
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <form method="POST" class="mt-3" action="{{ route('company-password.email') }}">
        @csrf

        <div class="form-group  position-relative">
          <input id="email" type="email" class="form-control pl-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="@lang('company/auth.workEmailAddress')">

          <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


        <div class=" mt-3 ">
          <button type="submit" class="btn btn-primary btn-block rounded">@lang('website/common.reset_password')</button>
        </div>

      </form>
    </div>
  </div>
</x-base-plain>
@endsection
