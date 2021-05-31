<template>
  <b-sidebar bg-variant="dark" backdrop id="admin-sidebar" :z-index="100" :shadow="true" width="15em">

    <b-list-group flush class=" mt-3  bg-dark">

      <b-list-group-item class="text-white d-flex " v-for="(v,i) in dataSidebar" :key="i" :to="v.url" active-class="bg-primary">
        <div class="text-center mr-2" style="width:20px;"><i :class="v.icon"></i></div> {{v.name}}
      </b-list-group-item>

    </b-list-group>

    <!-- <b-list-group flush>
      <b-list-group-item v-for="(v,i) in dataSidebarSecondary" :key="i" @click="handleClickSecondarySidebar(v.id)">
        {{v.name}}
      </b-list-group-item>

    </b-list-group> -->
  </b-sidebar>
</template>

<script>
  import {
    mapState,
    mapMutations,
    mapActions
  } from 'vuex'
  export default {
    name: 'Sidebar',
    components: {},
    data: function() {
      return {
        state: 'upcoming',
        dataSidebar: [{
            name: 'Dashboard',
            icon: ' fa fa-bar-chart',
            url: '/dashboard'
          },
          {
            name: 'Users',
            icon: ' fa fa-users',
            url: '/users'
          },
          {
            name: 'Companies',
            icon: ' fa fa-briefcase',
            url: '/companies'
          },
          {
            name: 'Reviews',
            icon: ' fa fa-comments',
            url: '/reviews'
          },
          {
            name: 'Membership',
            icon: ' fa fa-id-badge',
            url: '/membership'
          },
          {
            name: '3rd Parties',
            icon: ' fa fa-key',
            url: '/thirdparties'
          },
          {
            name: 'Editor',
            icon: ' fa fa-edit',
            url: '/editor'
          },
          {
            name: 'Adsense',
            icon: ' fa fa-money',
            url: '/adsense'
          },
          {
            name: 'Register',
            icon: ' fa fa-user-secret',
            url: '/register'
          },
        ]
      }
    },
    created() {},
    mounted() {

    },
    computed: {
      ...mapState({
        openSidebar: state => state.openSidebar
      }),

    },
    methods: {



    },
  }
</script>
<style lang="scss">

</style>
