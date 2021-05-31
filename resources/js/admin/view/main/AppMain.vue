<template>
  <div class="h-100">
    <navbar />
    <sidebar />
    <router-view></router-view>

  </div>
</template>
<script>
  import Navbar from '../../components/navbar/Navbar.vue'
  import Sidebar from '../../components/sidebars/Sidebar.vue'
  export default {
    components: {
      Navbar,
      Sidebar
    },
    name: 'AppMain',
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
