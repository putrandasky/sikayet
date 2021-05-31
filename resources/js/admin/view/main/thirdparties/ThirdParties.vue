<template>
  <b-container class="py-3">
    <b-card header-tag="nav">
      <template #header>
        <b-nav card-header tabs>
          <b-nav-item active-class="active" to="/thirdparties/payment">Payment</b-nav-item>
          <b-nav-item active-class="active" to="/thirdparties/social">Social</b-nav-item>
        </b-nav>
      </template>
      <router-view></router-view>
    </b-card>
  </b-container>
</template>
<script>
  export default {
    name: 'Reviews',
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
