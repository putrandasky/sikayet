@extends('layouts.website')


@section('content')
<x-base-plain>
  @slot('image')
  cover-login.jpg
  @endslot
  <div class="d-flex justify-content-center align-items-center h-100 px-3">
    <div id="login-form" class="text-center card  p-3">
      <div class=" pb-3 border-bottom">
        <h3 class="mb-0">APP Logo</h3>
      </div>
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <form method="POST" class="mt-3" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group  position-relative">
          <input id="email" type="email" class="form-control pl-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

          <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>


        <div class=" mt-3 ">
          <button type="submit" class="btn btn-primary btn-block rounded">Reset Password</button>
        </div>

      </form>

    </div>
  </div>
</x-base-plain>
@endsection
