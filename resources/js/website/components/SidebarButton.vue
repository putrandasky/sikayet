<template>
  <b-btn variant="outline-secondary" @click="submit">
    <i class="fa fa-list"></i>
  </b-btn>
</template>
<script>
  export default {
    name: 'SidebarButton',
    data: function() {
      return {}
    },
    created() {},
    methods: {
      submit() {
        alert('submit');
      }
    },
  }
</script>
<style>
</style>
