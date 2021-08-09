<template>
  <div class="h-100 position-relative">
    <div id="login-form" class="text-center position-absolute bg-white h-100 px-3" style="right:0">
      <div class=" py-3 border-bottom">
        <a href="/">
          <b-img style="max-height:30px" src="/images/logo-large.png" alt="application logo"></b-img>
        </a>

      </div>
      <div class="mt-3">
        <h4>{{'auth.businessAccountLogin' | trans}}</h4>
      </div>
      <div class="mt-3">
        <b-form-group class="position-relative" :invalid-feedback="errors.name" :state="stateName">
          <b-form-input type="text" class="form-control pl-5" :placeholder="'auth.companyName' | trans" v-model="input.name" :state="stateName"></b-form-input>
          <i class="fa fa-briefcase position-absolute text-secondary" style="top:12px;left:18px"></i>
        </b-form-group>
        <!-- <div class="form-group  position-relative">
          <input type="text" class="form-control pl-5" placeholder="Category">
          <i class="fa fa-list position-absolute text-secondary" style="top:12px;left:18px"></i>
        </div> -->
        <b-form-group class="position-relative" :invalid-feedback="errors.business_category" :state="stateBusinessCategory">
          <b-form-select class="pl-5" v-model="input.business_category" :options="category_options" :state="stateBusinessCategory">
            <b-form-select-option :value="null" disabled>-- {{'auth.selectBusinessCategory' | trans}} --</b-form-select-option>
          </b-form-select>
          <i class="fa fa-list position-absolute text-secondary" style="top:12px;left:18px"></i>

        </b-form-group>
        <b-form-group class="position-relative" :invalid-feedback="errors.email" :state="stateEmail">
          <b-form-input type="email" class="form-control pl-5" :placeholder="'auth.workEmailAddress' | trans" v-model="input.email" :state="stateEmail"></b-form-input>
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
          <b-btn variant="primary" block @click="submit">
            {{'auth.register' | trans}}
          </b-btn>
        </div>
        <div class="mt-3 text-center">
          {{'auth.alreadyHaveBusinessAccount' | trans}} <a href="/company-login">{{'auth.signIn' | trans}}</a>
        </div>
      </div>

    </div>
    <b-modal v-model="submitedModal" hide-footer :title="'auth.postRegisterCompanyMessageTitle' | trans" no-close-on-backdrop>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />
      <div>
        {{'auth.postRegisterCompanyMessage1' | trans}}
      </div>
      <div>
        {{'auth.postRegisterCompanyMessage2' | trans}}
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
    props: ['category'],
    components: {
      Lottie
    },
    data: function() {
      return {
        defaultOptions: {
          animationData: animationData,
          loop: false
        },
        input: {
          name: '',
          email: '',
          business_category: null,
          password: '',
          password_confirmation: ''
        },
        errors: {
          name: '',
          email: '',
          business_category: '',
          password: '',
          password_confirmation: ''
        },
        category_options: [],
        isLoading: false,
        submitedModal: false,
        isPasswordOpen: false,
      }
    },
    mounted() {
      this.category_options = this.mutateKey(this.category)
    },
    computed: {
      stateName() {
        return this.errors.name == 'no-error' ? true : this.errors.name ? false : null
      },
      stateEmail() {
        return this.errors.email == 'no-error' ? true : this.errors.email ? false : null
      },
      stateBusinessCategory() {
        return this.errors.business_category == 'no-error' ? true : this.errors.business_category ? false : null
      },
      statePassword() {
        return this.errors.password == 'no-error' ? true : this.errors.password ? false : null
      },
    },
    methods: {
      handleAnimation: function(anim) {
        this.anim = anim;
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          return {
            value: item.id,
            text: item.range || item.name || item.description,
            state: false
          };
        });
        return mutateData;
      },
      submit() {
        console.log('submit');
        let self = this
        this.isLoading = true
        axios.post(`/company-register`, this.input)
          .then((response) => {
            console.log(response.data)
            this.isLoading = false
            this.submitedModal = true
            let input = {
              name: '',
              email: '',
              business_category: null,
              password: '',
              password_confirmation: ''
            }
            self.input = input
          })
          .catch((error) => {
            self.isLoading = false
            let errors = error.response.data.errors
            this.errors.name = errors.name ? errors.name[0] : 'no-error';
            this.errors.business_category = errors.business_category ? errors.business_category[0] : 'no-error';
            this.errors.email = errors.email ? errors.email[0] : 'no-error';
            this.errors.password = errors.password ? errors.password[0] : 'no-error';
            console.log(errors);
          })
        // setTimeout(() => {
        //   this.isLoading = false
        //   this.submitedModal = true
        // }, 1000);
      }
    },
  }
</script>
<style>
</style>
