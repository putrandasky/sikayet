<template>
  <b-container fluid class="py-3">
    <b-card header-tag="nav">
      <template #header>
        <b-nav card-header tabs>
          <b-nav-item active-class="active" to="/companies/unactive">Unactive</b-nav-item>
          <b-nav-item active-class="active" to="/companies/regular">Regular</b-nav-item>
          <b-nav-item active-class="active" to="/companies/premium">Premium</b-nav-item>
          <b-nav-item active-class="active" to="/companies/suspended">Suspended</b-nav-item>
        </b-nav>
      </template>
      <router-view></router-view>
    </b-card>
  </b-container>
</template>
<script>
  export default {
    name: 'Users',

    data: function() {
      return {

      }
    },
    created() {},
    methods: {

    },
  }
</script>
<style>
</style>
