<template>
  <b-container class="py-3">
    <b-card header-tag="nav">
      <template #header>
        <b-nav card-header tabs>
          <b-nav-item active-class="active" to="/reviews/new">In Review</b-nav-item>
          <!-- <b-nav-item active-class="active" to="/reviews/active">Active Review</b-nav-item> -->
          <b-nav-item active-class="active" to="/reviews/reported">Reported</b-nav-item>
          <b-nav-item active-class="active" to="/reviews/suspended">Suspended</b-nav-item>
          <b-nav-item active-class="active" to="/reviews/orphans">Orphans</b-nav-item>
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
