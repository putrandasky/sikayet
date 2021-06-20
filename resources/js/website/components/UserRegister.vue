<template>
  <b-form @submit="submit" class="mt-3">
    <b-form-group class="position-relative" :invalid-feedback="errors.name" :state="stateName">
      <b-form-input type="text" class="form-control pl-5" placeholder="Full Name" v-model="input.name" :state="stateName"></b-form-input>
      <i class="fa fa-briefcase position-absolute text-secondary" style="top:12px;left:18px"></i>
    </b-form-group>
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
    <b-form-group class="position-relative">
      <b-form-input :type="isPasswordOpen? 'text':'password'" class="form-control pl-5" placeholder="Confirm Password" v-model="input.password_confirmation"></b-form-input>
      <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
    </b-form-group>
    <div class=" mt-3 ">
      <b-btn type="submit" variant="primary" block class="rounded">Register</b-btn>
    </div>
    <div class="mt-3 text-center">
      Already have Account? <a href="/user-login">Sign In</a>
    </div>
  </b-form>
</template>
<script>
  export default {
    name: 'UserRegister',
    data: function() {
      return {
        input: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
        },
        errors: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',

        },
        isPasswordOpen: false,
        isLoading: false,

      }
    },
    created() {},
    computed: {
      stateName() {
        return this.errors.name == 'no-error' ? true : this.errors.name ? false : null
      },
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
        axios.post(`/user-register`, this.input)
          .then((response) => {
            console.log(response.data)
            self.isLoading = false
            let input = {
              name: '',
              email: '',
              password: '',
              password_confirmation: ''

            }
            self.input = input
            window.open('/user-dashboard', '_self')
          })
          .catch((error) => {
            self.isLoading = false
            // let input = {
            //   name: '',
            //   email: '',
            //   password: '',
            //   password_confirmation: ''
            // }
            // self.input = input
            let errors = error.response.data.errors
            this.errors.name = errors.name ? errors.name[0] : 'no-error';
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
