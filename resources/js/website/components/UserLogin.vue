<template>
  <b-form @submit="submit" class="mt-3">
    <b-form-group class="position-relative" :invalid-feedback="errors.email" :state="stateEmail">
      <b-form-input type="email" class="form-control pl-5" placeholder="Email" v-model="input.email" :state="stateEmail"></b-form-input>
      <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
    </b-form-group>
    <b-form-group class="position-relative" :invalid-feedback="errors.password" :state="statePassword">
      <b-form-input :type="isPasswordOpen? 'text':'password'" class="form-control pl-5" placeholder="Password" v-model="input.password" :state="statePassword"></b-form-input>
      <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
      <i v-show="!isPasswordOpen" class="fa fa-eye position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = true"></i>
      <i v-show="isPasswordOpen" class="fa fa-eye-slash position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = false"></i>

    </b-form-group>
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
      <b-btn type="submit" variant="primary" block class="rounded">Login</b-btn>
    </div>
    <div class="mt-3 text-center">
      Don't have Account? <a href="/user-register">Sign Up</a>
    </div>
  </b-form>
</template>
<script>
  export default {
    name: 'UserLogin',
    data: function() {
      return {
        input: {
          email: '',
          password: '',
        },
        errors: {
          email: '',
          password: '',
        },
        isPasswordOpen: false,
        isLoading: false,

      }
    },
    created() {},
    computed: {

      stateEmail() {
        return this.errors.email == 'no-error' ? true : this.errors.email ? false : null
      },

      statePassword() {
        return this.errors.password == 'no-error' ? true : this.errors.password ? false : null
      },
    },
    methods: {
      submit(e) {
        e.preventDefault()

        let self = this
        this.isLoading = true
        axios.post(`/user-login`, this.input)
          .then((response) => {
            console.log(response.data)
            self.isLoading = false
            let input = {
              email: '',
              password: '',
            }
            self.input = input
            window.open('/user-dashboard', '_self')
          })
          .catch((error) => {
            self.isLoading = false
            // let input = {
            //   email: '',
            //   password: '',
            // }
            // self.input = input
            let errors = error.response.data.errors
            this.errors.email = errors.email ? errors.email[0] : 'no-error';
            this.errors.password = errors.password ? errors.password[0] : 'no-error';
          })
        // setTimeout(() => {
        // this.isLoading = false
        // this.submitedModal = true
        // }, 1000);
      }

    },
  }
</script>
<style>
</style>
