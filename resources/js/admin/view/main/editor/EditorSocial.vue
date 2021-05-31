<template>
  <div>
    <b-form-group v-for="v,i in data" :key="i" :label="`URL for ${v.name}`">
      <b-form-input v-model="v.url"></b-form-input>
    </b-form-group>
    <b-btn class="float-right" size="sm" variant="success">Submit</b-btn>
  </div>
</template>
<script>
  export default {
    name: 'EditorSocial',
    data: function() {
      return {
        data: [{
            name: 'facebook',
            url: ''
          },
          {
            name: 'instagram',
            url: ''
          },
          {
            name: 'linkedin',
            url: ''
          },
          {
            name: 'google',
            url: ''
          },
          {
            name: 'email',
            url: ''
          }
        ]
      }
    },
    methods: {

    }
  }
</script>
<style>
</style>
