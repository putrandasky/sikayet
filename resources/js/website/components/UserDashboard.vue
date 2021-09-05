<template>
  <div>
    <b-nav tabs class="mb-3" style="overflow-x: auto;overflow-y: hidden;
    white-space: nowrap;
    flex-wrap: unset;">
      <b-nav-item :active="component == 'MyReview'" @click="component = 'MyReview'">{{'dashboard.review.title' | trans}}</b-nav-item>
      <b-nav-item :active="component == 'MyProfile'" @click="component = 'MyProfile'">{{'dashboard.profile.title' | trans}}</b-nav-item>
      <b-nav-item>
        <b-btn variant="danger" size="sm" @click="logout()">{{'auth.logout' | trans | upper}}</b-btn>

      </b-nav-item>
    </b-nav>
    <component :userdata="user" v-bind:is="component"></component>
  </div>
</template>
<script>
  import MyReview from "./UserDashboardMyReview"
  import MyProfile from "./UserDashboardMyProfile"
  export default {

    name: 'UserDashboard',
    props: ['user'],
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
    methods: {
      logout() {
        window.open('/user-logout', '_self')
      }
    },
  }
</script>
<style>
</style>
