<template>
  <div class="h-100 position-relative">
    <div id="login-form" class="text-center position-absolute bg-white h-100 px-3" style="right:0">
      <div class=" py-3 border-bottom">
        <h3 class="mb-0">APP Logo</h3>
      </div>
      <div class="mt-3">
        <h4>Business Account Login</h4>
      </div>
      <form action="" class="mt-3">
        <div class="form-group  position-relative">
          <input type="email" class="form-control pl-5" placeholder="Working Email Address">
          <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="form-group  position-relative">
          <input type="password" class="form-control pl-5" placeholder="Password">
          <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="d-flex    justify-content-between">
          <div class="">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="remember-me-user">
              <label class="form-check-label" for="remember-me-user">
                Remember Me
              </label>
            </div>
          </div>
          <div>
            <a class="text-dark" href="">Forgot Password?</a>
          </div>
        </div>
        <div class=" mt-3 ">
          <a class="btn btn-primary btn-block rounded" href="/company-dashboard">Login</a>
        </div>
        <div class="mt-3 text-center">
          Don't have Business Account? <a href="/company-register">Sign Up</a>
        </div>
      </form>

    </div>
  </div>
</template>
<script>
  export default {
    name: 'CompanyLogin',
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
