<template>
  <div>
    <b-row>
      <b-col md="6">
        <h3>My Profile</h3>

        <b-form-group label="Profile">
          <b-form-textarea v-model="input.profile" rows="3"></b-form-textarea>
        </b-form-group>
        <b-form-group label="Email">
          <b-form-input type="email" disabled v-model="input.email"></b-form-input>
        </b-form-group>
        <b-form-group label="Full Name">
          <b-form-input type="text" v-model="input.name"></b-form-input>
        </b-form-group>
        <!-- <b-form-group id="review-name" label="Name">
        <b-form-input type="text" v-model="input.name"></b-form-input>
      </b-form-group> -->
        <b-btn class="mt-3 float-right" variant="primary" @click="updateData">Update Profile</b-btn>
      </b-col>
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
        password: {
          current: '',
          password: '',
          password_confirmation: ''
        }
      }
    },
    created() {},
    mounted() {
      this.input = this.userdata
    },
    methods: {
      updateData() {
        axios.post(`/user-dashboard/profile`, this.input)
          .then((response) => {
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
          })
      }
    },
  }
</script>
<style>
</style>
