<template>
  <tip-tap v-model="data" />
</template>
<script>
  import TipTap from '../../../components/texteditor/TipTap.vue'
  export default {
    components: {
      TipTap
    },
    name: 'EditorTerms',
    data: function() {
      return {
        data: ''
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
