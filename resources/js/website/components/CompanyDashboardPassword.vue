<template>
  <b-row>

    <b-col md="6">
      <h3>Change Password</h3>

      <b-form-group label="Current Password">
        <b-form-input type="password" v-model="password.current"></b-form-input>
      </b-form-group>
      <b-form-group label="New Password">
        <b-form-input type="password" v-model="password.password"></b-form-input>
      </b-form-group>
      <b-form-group label="Confirm New Password">
        <b-form-input type="password" v-model="password.password_confirmation"></b-form-input>
      </b-form-group>
      <b-btn class="mt-auto float-right" variant="primary">Change Password</b-btn>

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
          current: '',
          password: '',
          password_confirmation: ''
        }
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
