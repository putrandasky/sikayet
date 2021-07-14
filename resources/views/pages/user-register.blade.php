@extends('layouts.website')

@section('meta')
<title>User Register | {{config('app.name')}}</title>
<meta property="og:title" content="User Register | {{config('app.name')}}" />
<meta property="og:site_name" content="User Register | {{config('app.name')}}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('images/icon.png') }}">
<meta property="og:url" content="{{config('app.url')}}" />
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="User Register | {{config('app.name')}}">
<meta name="twitter:image:src" content="{{ asset('images/icon.png') }}">
<meta name="twitter:image" content="{{ asset('images/icon.png') }}">


@endsection

@section('content')
<x-base-plain>
  @slot('image')
  cover-login.jpg
  @endslot
  <div class="d-flex justify-content-center align-items-center h-100 px-3">
    {{-- <div id="login-form" class="text-center card  p-3">
      <div class=" pb-3 border-bottom">
  <a href="/">
    <img class="img-fluid" style="max-height:30px" src="/images/logo-large.png" alt="application logo"></img>
  </a> </div>
      <div class=" py-2">
        <a href="{{ url('facebook') }}" class="btn btn-block text-white" style="background-color: #3B5998;">
          <i class="fa fa-facebook"> </i>
          Register with Facebook</a>
        <a href="{{ url('google') }}" class="btn btn-block text-white" style="background-color: #DC4E41;">
          <i class="fa fa-google"> </i>
          Register with Google</a>
      </div>
      <div>
        OR
      </div> --}}
      <user-register :social-login-status="'{{ session('status') ?? '' }}'"></user-register>
      {{-- <form method="POST" action="{{ route('user-register') }}" class="mt-2">
        @csrf
        <div class="form-group  position-relative">
          <input id="name" type="text" class="form-control pl-5 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">
          <i class="fa fa-user position-absolute text-secondary" style="top:12px;left:18px"></i>
          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group  position-relative">
          <input id="email" type="email" class="form-control pl-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
          <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group  position-relative">
          <input id="password" type="password" class="form-control pl-5 @error('password') is-invalid @enderror" name="password" required placeholder="Password">
          <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group  position-relative">
          <input id="password-confirm" type="password" class="form-control pl-5" name="password_confirmation" required placeholder="Confirm Password">
          <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>

        <div class=" mt-3 ">
          <button class="btn btn-primary btn-block rounded">{{ __('Register') }}</button>
        </div>
        <div class="mt-3 text-center">
          Already have Account? <a href="/user-login">Sign In</a>
        </div>
      </form> --}}

    {{-- </div> --}}
  </div>
</x-base-plain>
@endsection
