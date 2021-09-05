<template>
  <b-navbar id="main-navbar" sticky type="light" variant="light" class="navbar-expand-sm navbar--ontop fixed-top  px-md-5 shadow-sm " style="z-index:800;min-height:45px;height:45px">
    <b-navbar-nav class="d-flex d-md-none mr-auto">
      <b-btn variant="outline-secondary" v-b-toggle="'sidebar-1'">
        <i class="fa fa-list"></i>
      </b-btn>
    </b-navbar-nav>
    <b-navbar-brand class="mr-auto  d-none d-md-flex" href="/">
      <b-img style="min-height:30px;height:30px" src="/images/logo.png" alt="application logo"></b-img>
      <!-- APP LOGO -->

    </b-navbar-brand>
    <b-navbar-brand class="center-h   d-flex d-md-none" href="/">
      <b-img style="min-height:30px;height:30px" src="/images/logo.png" alt="application logo"></b-img>
      <!-- APP LOGO -->

    </b-navbar-brand>

    <b-navbar-nav class="d-none ml-auto d-md-flex d-none ">

      <b-nav-item href="/about">{{'nav.about' | trans}}</b-nav-item>
      <b-nav-item href="/contact">{{'nav.contact' | trans}}</b-nav-item>
      <b-nav-item href="/faq">{{'nav.faq' | trans}}</b-nav-item>


    </b-navbar-nav>
    <b-navbar-nav class="justify-content-end d-none d-md-flex ">
      <a v-if="!iscompany" class="mr-2 btn btn-sm btn-primary" href="/write-review">{{'nav.writeReview' | trans}}</a>
      <a v-if="!iscompany && !isuser" class="mr-2 btn btn-sm btn-dark" href="/company-login">{{'nav.forCompanies' | trans}}</a>



    </b-navbar-nav>
    <b-navbar-nav class="justify-content-end">
      <a v-if="!iscompany && !isuser" class="btn-sm btn btn-outline-secondary" href="/user-login">
        {{'auth.memberLogin' | trans}}
      </a>
      <a v-if="isuser" class="btn-sm btn btn-outline-secondary" href="/user-dashboard"><i class="fa fa-user"></i></a>
      <a v-if="iscompany" class="btn-sm btn btn-outline-secondary" href="/company-dashboard"><i class="fa fa-briefcase"></i></a>

    </b-navbar-nav>



    <b-sidebar body-class="px-3" bg-variant="dark" title="Navigation" backdrop id="sidebar-1" :z-index="1001" :shadow="true">
      <b-list-group flush class="mt-3 bg-dark">

        <b-list-group-item href="/faq" class="bg-dark text-white border-bottom border-light">
          {{'nav.faq' | trans}}
        </b-list-group-item>
        <b-list-group-item href="/contact" class="bg-dark text-white border-bottom border-light">
          {{'nav.contact' | trans}}
        </b-list-group-item>
        <b-list-group-item href="/about" class="bg-dark text-white border-bottom border-light">
          {{'nav.about' | trans}}
        </b-list-group-item>
      </b-list-group>
      <div class="mt-3">

        <a v-if="!iscompany" class="mr-2 btn btn-sm btn-primary" href="/write-review">{{'nav.writeReview' | trans}}</a>
        <a v-if="!iscompany && !isuser" class="mr-2 btn btn-sm btn-dark" href="/company-login">{{'nav.forCompanies' | trans}}</a>
      </div>
    </b-sidebar>
  </b-navbar>
</template>
<script>
  export default {
    name: 'Navbar',
    props: {
      isuser: {
        type: Boolean,
        default: false
      },
      iscompany: {
        type: Boolean,
        default: false
      }
    },
    components: {

    },
    data: function() {
      return {}
    },
    created() {},

    computed: {},
    methods: {},
  }
</script>
<style>
</style>
