<template>
  <div>
    <b-alert :variant="alert.status" :show="alert.status != ''">
      {{alert.message}}
    </b-alert>
    <b-form @submit="submit" class="mt-3">
      <b-form-group class="position-relative" :invalid-feedback="errors.email" :state="stateEmail">
        <b-form-input type="email" class="form-control pl-5" :placeholder="'auth.workEmailAddress' | trans" v-model="input.email" :state="stateEmail" autocomplete="on"></b-form-input>
        <i class="fa fa-envelope position-absolute text-secondary" style="top:12px;left:18px"></i>
      </b-form-group>
      <b-form-group class="position-relative" :invalid-feedback="errors.password" :state="statePassword">
        <b-form-input :type="isPasswordOpen? 'text':'password'" class="form-control pl-5" :placeholder="'auth.password' | trans" v-model="input.password" :state="statePassword" autocomplete="on"></b-form-input>
        <i class="fa fa-key position-absolute text-secondary" style="top:12px;left:18px"></i>
        <i v-show="!isPasswordOpen" class="fa fa-eye position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = true"></i>
        <i v-show="isPasswordOpen" class="fa fa-eye-slash position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = false"></i>

      </b-form-group>
      <div class="d-flex    justify-content-between">
        <div class="">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember-me-user" v-model="input.remember">
            <label class="form-check-label" for="remember-me-user">
              {{'auth.rememberMe' | trans}}
            </label>
          </div>
        </div>
        <div>
          <a class="text-dark" href="/company-forgot-password">{{'auth.forgotPassword' | trans}}</a>
        </div>
      </div>
      <div class=" mt-3 ">
        <b-btn type="submit" variant="primary" block class="rounded">{{'auth.login' | trans}}</b-btn>
      </div>
      <div class="mt-3 text-center">
        {{'auth.dontHaveBusinessAccount' | trans}} <a href="/company-register">{{'auth.pleaseSignUp' | trans}}</a>
      </div>
      <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>
    </b-form>
  </div>

</template>
<script>
  export default {
    name: 'CompanyLogin',
    data: function() {
      return {
        input: {
          email: '',
          password: '',
          remember: false
        },
        errors: {
          email: '',
          password: '',
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
        axios.post(`/company-login`, this.input)
          .then((response) => {
            console.log(response.data)
            self.isLoading = false
            let input = {
              email: '',
              password: '',
            }
            self.input = input
            window.open('/company-dashboard', '_self')
          })
          .catch((error) => {
            self.isLoading = false

            self.errors = {
              email: '',
              password: '',
            }
            // this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            self.alert.status = errors ? 'danger' : error.response.data.status
            self.alert.message = error.response.data.message
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
