<template>
  <b-card id="login-form" class="text-center">
    <b-card-title>
      <a href="/">
        <b-img fluid style="max-height:30px" src="/images/logo-large.png" alt="application logo"></b-img>
      </a>

    </b-card-title>
    <b-alert :show="socialLoginStatus != ''" variant="warning">
      {{socialLoginStatus}}
    </b-alert>
    <b-alert :variant="alert.status" :show="alert.status != ''">
      {{alert.message}}
    </b-alert>
    <div class="py-2">
      <a href="/facebook" class="btn btn-block text-white" style="background-color: #3B5998;">
        <i class="fa fa-facebook"> </i>
        {{'auth.loginWith' | trans}} Facebook</a>
      <a href="/google" class="btn btn-block text-white" style="background-color: #DC4E41;">
        <i class="fa fa-google"> </i>
        {{'auth.loginWith' | trans}} Google</a>
    </div>
    <div>
      OR
    </div>
    <b-form @submit="submit" class="mt-2">
      <b-form-group class="position-relative" :invalid-feedback="errors.name" :state="stateName">
        <b-form-input type="text" class="form-control pl-5" :placeholder="'auth.fullName' | trans" v-model="input.name" :state="stateName"></b-form-input>
        <i class="fa fa-briefcase position-absolute text-secondary" style="top:12px;left:18px"></i>
      </b-form-group>
      <b-form-group class="position-relative" :invalid-feedback="errors.email" :state="stateEmail">
        <b-form-input type="email" class="form-control pl-5" :placeholder="'auth.email' | trans" v-model="input.email" :state="stateEmail"></b-form-input>
        <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
      </b-form-group>
      <b-form-group class="position-relative" :invalid-feedback="errors.password" :state="statePassword">
        <b-form-input :type="isPasswordOpen? 'text':'password'" class="form-control pl-5" :placeholder="'auth.password' | trans" v-model="input.password" :state="statePassword"></b-form-input>
        <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        <i v-show="!isPasswordOpen" class="fa fa-eye position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = true"></i>
        <i v-show="isPasswordOpen" class="fa fa-eye-slash position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = false"></i>

      </b-form-group>
      <b-form-group class="position-relative">
        <b-form-input :type="isPasswordOpen? 'text':'password'" class="form-control pl-5" :placeholder="'auth.confirmPassword' | trans" v-model="input.password_confirmation"></b-form-input>
        <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
      </b-form-group>
      <div class=" mt-3 ">
        <b-btn type="submit" variant="primary" block class="rounded">{{'auth.register' | trans}}</b-btn>
      </div>
      <div class="mt-3 text-center" v-if="!hideLoginLink">
        {{'auth.alreadyHaveAccount' | trans}} <a href="/user-login">{{'auth.signIn' | trans}}</a>
      </div>
      <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>

    </b-form>
  </b-card>

</template>
<script>
  export default {
    name: 'UserRegister',
    props: {
      socialLoginStatus: {
        type: String,
        default: ''
      },
      hideLoginLink: {
        type: Boolean,
        default: false
      },

      targetWindowReload: {
        type: String,
        default: '/user-dashboard'
      }
    },
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
        alert: {
          status: '',
          message: ''
        }
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
            window.open(this.targetWindowReload, '_self')
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
            self.alert.status = errors ? 'danger' : error.response.data.status
            self.alert.message = error.response.data.message
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
