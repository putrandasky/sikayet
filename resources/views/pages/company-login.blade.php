@extends('layouts.website')

@section('meta')
<title>@lang('company/auth.title.login') | {{config('app.name')}}</title>
<meta property="og:title" content="@lang('company/auth.title.login') | {{config('app.name')}}" />
<meta property="og:site_name" content="@lang('company/auth.title.login') | {{config('app.name')}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('images/icon.png') }}">
<meta property="og:url" content="{{config('app.url')}}" />
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="@lang('company/auth.title.login') | {{config('app.name')}}">
<meta name="twitter:image:src" content="{{ asset('images/icon.png') }}">
<meta name="twitter:image" content="{{ asset('images/icon.png') }}">


@endsection


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
        <h4>@lang('company/auth.view.business_account_login')</h4>
      </div>
             @if (session('status'))
             <div class="alert alert-info" role="alert">
               {{ session('status') }}
             </div>
             @endif
      <company-login />
    </div>

  </div>
</x-base-plain>
@endsection
