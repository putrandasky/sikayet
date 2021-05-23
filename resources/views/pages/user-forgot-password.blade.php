@extends('layouts.website')


@section('content')
<x-base-plain>
  @slot('image')
  cover-login.jpg
  @endslot
  <div class="h-100">
    <div id="login-form" class="text-center bg-white h-100 px-3" ">
      <div class=" py-3 border-bottom">
      <h3 class="mb-0">APP Logo</h3>
    </div>
    <form action="" class="mt-3">
      <div class="form-group  position-relative">
        <input type="email" class="form-control pl-5" id="formGroupExampleInput" placeholder="Email">
        <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>


      <div class=" mt-3 ">
        <button class="btn btn-primary btn-block rounded">Reset Password</button>
      </div>

    </form>

  </div>
  </div>
</x-base-plain>
@endsection
