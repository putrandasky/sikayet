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
        <h4>Business Account Login</h4>
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
