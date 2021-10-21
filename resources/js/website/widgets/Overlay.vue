<template>
  <b-overlay variant="dark" :show="!isLoaded" blur="">
    <template #overlay>
      <div class="text-center mt-5">
        <b-spinner label="Spinning"></b-spinner>
        <div>
          {{'common.please_wait'|trans}}
        </div>
      </div>
    </template>
  </b-overlay>
</template>
<script>
  export default {
    name: 'Overlay',
    props: {
      isLoaded: {
        type: Boolean,
        default: false,
      }
    },
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
