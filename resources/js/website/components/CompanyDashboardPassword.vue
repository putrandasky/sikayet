<template>
  <b-row>

    <b-col md="6">
      <h3>Change Password</h3>
      <div>

        <b-form-group class="position-relative" label="Current Password" :invalid-feedback="errors_password.current_password" :state="stateCurrentPassword">
          <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.current_password" :state="stateCurrentPassword"></b-form-input>
          <i v-show="!isPasswordOpen" class="fa fa-eye position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = true"></i>
          <i v-show="isPasswordOpen" class="fa fa-eye-slash position-absolute text-secondary" style="top:12px;right:18px" @click="isPasswordOpen = false"></i>

        </b-form-group>
        <b-form-group label="New Password" :invalid-feedback="errors_password.password" :state="statePassword">
          <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.password" :state="statePassword"></b-form-input>
        </b-form-group>
        <b-form-group label="Confirm New Password">
          <b-form-input :type="isPasswordOpen? 'text':'password'" v-model="password.password_confirmation"></b-form-input>
        </b-form-group>
        <b-btn class="mt-auto float-right" variant="primary" @click="updatePassword">Change Password</b-btn>
      </div>

    </b-col>
    <b-col md="6">
    </b-col>
  </b-row>
</template>
<script>
  export default {
    name: 'CompanyDashboardPassword',
    data: function() {
      return {
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
    computed: {
      stateCurrentPassword() {
        return this.errors_password.current_password == 'no-error' ? true : this.errors_password.current_password ? false : null
      },
      statePassword() {
        return this.errors_password.password == 'no-error' ? true : this.errors_password.password ? false : null
      },
    },
    methods: {
      updatePassword() {
        axios.post(`/company-dashboard/password`, this.password)
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
