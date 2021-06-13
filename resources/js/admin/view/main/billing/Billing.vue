<template>
  <b-container fluid class="py-3">
    <b-card header-tag="nav">
      <template #header>
        <b-nav card-header tabs>
          <b-nav-item active-class="active" to="/billings/unpaid">Unpaid</b-nav-item>
          <b-nav-item active-class="active" to="/billings/paid">Paid</b-nav-item>
        </b-nav>
      </template>
      <router-view></router-view>
    </b-card>
  </b-container>
</template>
<script>
  export default {
    name: 'Billing',

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
