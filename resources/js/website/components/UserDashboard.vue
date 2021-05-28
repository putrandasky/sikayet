<template>
  <div>
    <b-nav tabs class="mb-3">
      <b-nav-item :active="component == 'MyReview'" @click="component = 'MyReview'">My Review</b-nav-item>
      <b-nav-item :active="component == 'MyProfile'" @click="component = 'MyProfile'">My Profile</b-nav-item>
      <b-nav-item>
        <b-btn variant="danger" size="sm">Log Out</b-btn>

      </b-nav-item>
    </b-nav>
    <component v-bind:is="component"></component>
  </div>
</template>
<script>
  import MyReview from "./UserDashboardMyReview"
  import MyProfile from "./UserDashboardMyProfile"
  export default {

    name: 'UserDashboard',
    components: {
      MyReview,
      MyProfile
    },
    data: function() {
      return {
        component: "MyReview"
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
