<template>
  <div>
    <b-sidebar body-class="px-3" bg-variant="dark" title="Navigation" backdrop id="sidebar-1" :z-index="1001" :shadow="true">
      <b-list-group flush class="mt-3 bg-dark">

        <b-list-group-item href="#" class="bg-dark text-white border-bottom border-light" @click="submit">
          FAQ
        </b-list-group-item>
        <b-list-group-item href="#" class="bg-dark text-white border-bottom border-light">
          {{'nav.contact' | trans}}
        </b-list-group-item>
        <b-list-group-item href="#" class="bg-dark text-white border-bottom border-light">
          {{'nav.about' | trans}}
        </b-list-group-item>
      </b-list-group>
      <div class="mt-3">

        <b-btn block variant="primary" size="sm">{{'nav.writeReview' | trans}}</b-btn>
        <b-btn block variant="light" size="sm">{{'nav.forCompanies' | trans}}</b-btn>
      </div>
    </b-sidebar>

  </div>
</template>
<script>
  export default {
    name: 'SidebarMenu',
    data: function() {
      return {
        menu: ['Contact, FAQ, ']

      }
    },
    created() {},
    computed: {

    },
    methods: {
      submit() {
        console.log('submit');
      }
    },
  }
</script>
<style scoped>

</style>
