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
    <div class=" py-2">
      <button class="btn btn-block text-white" style="background-color: #3B5998;">
        <i class="fa fa-facebook"> </i>
        Register with Facebook</button>
      <button class="btn btn-block text-white" style="background-color: #DC4E41;">
        <i class="fa fa-google"> </i>
        Register with Google</button>
    </div>
    <div>
      OR
    </div>
    <form action="" class="mt-2">
      <div class="form-group  position-relative">
        <input type="text" class="form-control pl-5"  placeholder="Name">
        <i class="fa fa-user position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>
      <div class="form-group  position-relative">
        <input type="text" class="form-control pl-5"  placeholder="Last Name">
        <i class="fa fa-user position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>
      <div class="form-group  position-relative">
        <input type="email" class="form-control pl-5"  placeholder="Email">
        <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>
      <div class="form-group  position-relative">
        <input type="password" class="form-control pl-5"  placeholder="Password">
        <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>
      <div class="form-group  position-relative">
        <input type="password" class="form-control pl-5"  placeholder="Confirm Password">
        <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
      </div>

      <div class=" mt-3 ">
        <button class="btn btn-primary btn-block rounded">Register</button>
      </div>
      <div class="mt-3 text-center">
        Already have Account? <a href="/user-login">Sign In</a>
      </div>
    </form>

  </div>
  </div>
</x-base-plain>
@endsection
