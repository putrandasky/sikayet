<template>
  <b-card header-class="text-center" class="shadow-sm" :class="variant" style="overflow:hidden">
    <div class="card-icon">
      <i :class="`fa fa-${icon}`"></i>
    </div>
    <div class="text-right">

      <h3 style="font-size:4em">{{data}}</h3>
      <h6>{{title | uppercase}}</h6>
    </div>

  </b-card>
</template>
<script>
  export default {
    props: [
      'title', 'variant', 'data', 'icon'
    ],
    name: 'DashboardPanel',
    data: function() {
      return {}
    },
    created() {},
    computed: {},
    methods: {},
  }
</script>
<style>
  .card-icon {
    position: absolute;
    z-index: 0;
    top: -0.50rem;
    left: -1rem;
    opacity: 0.4;
    font-size: 8rem;
    -webkit-transform: rotate(15deg);
    transform: rotate(15deg);
    overflow: hidden
  }
</style>
