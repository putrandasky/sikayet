<template>
  <b-container class="py-3">
    <b-card header-tag="nav">
      <template #header>
        <b-nav card-header tabs>
          <b-nav-item active-class="active" to="/editor/homepage">Homepage</b-nav-item>
          <b-nav-item active-class="active" to="/editor/faq">FAQ</b-nav-item>
          <b-nav-item active-class="active" to="/editor/about">About</b-nav-item>
          <b-nav-item active-class="active" to="/editor/membership-information">Membership</b-nav-item>
          <b-nav-item active-class="active" to="/editor/privacy-policy">Privacy</b-nav-item>
          <b-nav-item active-class="active" to="/editor/terms">Terms</b-nav-item>
          <b-nav-item active-class="active" to="/editor/agreement">Agreement</b-nav-item>
          <b-nav-item active-class="active" to="/editor/social">Social</b-nav-item>
        </b-nav>
      </template>
      <router-view></router-view>
    </b-card>
  </b-container>
</template>
<script>
  export default {
    name: 'Editor',
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
