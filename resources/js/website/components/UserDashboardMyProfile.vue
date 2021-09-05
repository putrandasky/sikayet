<template>
  <div>
    <b-row>
      <b-col md="6">
        <h3>{{'dashboard.profile.title' | trans}}</h3>
        <b-form-group :label="'auth.email' | trans">
          <b-form-input type="email" disabled v-model="input.email"></b-form-input>
        </b-form-group>
        <b-form-group :label="'auth.fullName' | trans" :invalid-feedback="errors.name" :state="stateName">
          <b-form-input type="text" v-model="input.name" :state="stateName"></b-form-input>
        </b-form-group>
        <b-form-group :label="'dashboard.profile.profile' | trans" :invalid-feedback="errors.profile" :state="stateProfile">
          <b-form-textarea v-model="input.profile" rows="3" :state="stateProfile"></b-form-textarea>
        </b-form-group>
        <!-- <b-form-group id="review-name" label="Name">
        <b-form-input type="text" v-model="input.name"></b-form-input>
      </b-form-group> -->
        <b-btn class="mt-3 float-right" variant="primary" @click="updateData">{{'dashboard.profile.update' | trans | upper }}</b-btn>
      </b-col>
      <b-col md="6">
        <h3>{{'auth.changePassword' | trans}}</h3>
        <div v-if="!userdata.facebook_id && !userdata.google_id">

          <b-form-group class="position-relative" :label="'auth.currentPassword' | trans" :invalid-feedback="errors_password.current_password" :state="stateCurrentPassword">
            <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.current_password" :state="stateCurrentPassword"></b-form-input>
            <i v-show="!isPasswordOpen" class="fa fa-eye position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = true"></i>
            <i v-show="isPasswordOpen" class="fa fa-eye-slash position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = false"></i>

          </b-form-group>
          <b-form-group :label="'auth.newPassword' | trans" :invalid-feedback="errors_password.password" :state="statePassword">
            <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.password" :state="statePassword"></b-form-input>
          </b-form-group>
          <b-form-group :label="'auth.confirmNewPassword' | trans">
            <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.password_confirmation"></b-form-input>
          </b-form-group>
          <b-btn class="mt-auto float-right" variant="primary" @click="updatePassword">{{'auth.changePassword' | trans | upper}}</b-btn>
        </div>
        <div v-if="userdata.facebook_id">
          {{'auth.warningChangePasswordFB' | trans}}
        </div>
        <div v-if="userdata.google_id">
          {{'auth.warningChangePasswordGoogle' | trans}}
        </div>
      </b-col>

    </b-row>
  </div>
</template>
<script>
  export default {
    name: 'UserDashboardMyProfile',
    props: ['userdata'],
    data: function() {
      return {
        input: {
          profile: '',
          email: '',
          name: '',
        },
        errors: {
          profile: '',
          name: '',
        },
        password: {
          current_password: '',
          password: '',
          password_confirmation: ''
        },
        errors_password: {
          current_password: '',
          password: '',
          password_confirmation: ''
        },
        isPasswordOpen: false,

      }
    },
    created() {},
    mounted() {
      this.input = this.userdata
    },
    computed: {
      stateCurrentPassword() {
        return this.errors_password.current_password == 'no-error' ? true : this.errors_password.current_password ? false : null
      },
      statePassword() {
        return this.errors_password.password == 'no-error' ? true : this.errors_password.password ? false : null
      },
      stateProfile() {
        return this.errors.profile == 'no-error' ? true : this.errors.profile ? false : null
      },
      stateName() {
        return this.errors.name == 'no-error' ? true : this.errors.name ? false : null
      },
    },
    methods: {
      updateData() {
        axios.post(`/user-dashboard/profile`, this.input)
          .then((response) => {
            this.toastSuccess(response.data.message)
            let errors = {
              profile: '',
              name: '',
            }
            this.errors = errors

          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.errors.profile = errors.profile ? errors.profile[0] : 'no-error';
            this.errors.name = errors.name ? errors.name[0] : 'no-error';
          })
      },
      updatePassword() {
        axios.post(`/user-dashboard/password`, this.password)
          .then((response) => {
            this.toastSuccess(response.data.message)
            let data = {
              current_password: '',
              password: '',
              password_confirmation: ''
            }
            let errors_password = {
              current_password: '',
              password: '',
              password_confirmation: ''
            }
            this.password = data
            this.errors_password = errors_password
          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.errors_password.current_password = errors.current_password ? errors.current_password[0] : 'no-error';
            this.errors_password.password = errors.password ? errors.password[0] : 'no-error';
          })
      }
    },
  }
</script>
<style>
</style>
