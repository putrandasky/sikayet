<template>
  <div class="h-100 position-relative">
    <div id="login-form" class="text-center position-absolute bg-white h-100 px-3" style="right:0">
      <div class=" py-3 border-bottom">
        <h3 class="mb-0">APP Logo</h3>
      </div>
      <div class="mt-3">
        <h4>Business Account Register</h4>
      </div>
      <div class="mt-3">
        <div class="form-group  position-relative">
          <input type="text" class="form-control pl-5" placeholder="Company Name">
          <i class="fa fa-briefcase position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="form-group  position-relative">
          <input type="text" class="form-control pl-5" placeholder="Category">
          <i class="fa fa-list position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="form-group  position-relative">
          <input type="email" class="form-control pl-5" placeholder="Work Email Address">
          <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="form-group  position-relative">
          <input type="password" class="form-control pl-5" placeholder="Password">
          <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>
        <div class="form-group  position-relative">
          <input type="password" class="form-control pl-5" placeholder="Confirm Password">
          <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div>

        <div class=" mt-3 ">
          <b-btn variant="primary" block @click="submit">
            Register
          </b-btn>
        </div>
        <div class="mt-3 text-center">
          Already have Business Account? <a href="/company-login">Sign In</a>
        </div>
      </div>

    </div>
    <b-modal v-model="submitedModal" hide-footer title="Thank you for registering your business account." no-close-on-backdrop>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />
      <div>
        We will activate your account as soon as possible and we will inform you by e-mail.
      </div>
      <div>
        have a nice day
      </div>
    </b-modal>
    <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>
  </div>
</template>
<script>
  import animationData from "../assets/submit.js";
  import Lottie from 'vue-lottie'
  export default {
    name: 'CompanyLogin',
    components: {
      Lottie
    },
    data: function() {
      return {
        defaultOptions: {
          animationData: animationData,
          loop: false
        },
        isLoading: false,
        submitedModal: false,
      }
    },
    created() {},
    methods: {
      handleAnimation: function(anim) {
        this.anim = anim;
      },
      submit() {
        console.log('submit');

        this.isLoading = true
        setTimeout(() => {
          this.isLoading = false
          this.submitedModal = true
        }, 1000);
      }
    },
  }
</script>
<style>
</style>
