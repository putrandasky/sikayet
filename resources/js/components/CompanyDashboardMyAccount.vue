<template>
  <div>
    <h3>My Account</h3>
    <b-row>
      <b-col md="6">


        <b-form-group label="Email">
          <b-form-input type="email" v-model="input.email"></b-form-input>
        </b-form-group>
        <b-form-group label="Company Name">
          <b-form-input type="text" v-model="input.name"></b-form-input>
        </b-form-group>

      </b-col>
      <b-col md="6">

        <b-form-group label="Website URL">
          <b-form-input type="password" v-model="input.website"></b-form-input>
        </b-form-group>

        <label>Company Picure</label>
        <b-form-file v-model="input.file" placeholder="Choose a file or drop it here..." drop-placeholder="Drop file here..."></b-form-file>


      </b-col>
      <b-col cols="12">
        <b-form-group label="Profile">
          <b-form-textarea v-model="input.profile" rows="3"></b-form-textarea>
        </b-form-group>
        <b-btn class="mt-3 float-right" variant="primary">Update Account</b-btn>
      </b-col>

    </b-row>
  </div>
</template>
<script>
  export default {
    name: 'CompanyDashboardMyAccount',
    data: function() {
      return {
        input: {
          profile: '',
          name: '',
          email: '',
          website: '',
          file: null,
        },
      }
    },
    created() {},
    methods: {

    },
  }
</script>
<style>
</style>
