<template>
  <div>
    <strong>Compose Term of Use</strong>
    <tip-tap v-model="data" />
    <b-btn size="sm" class="float-right mt-3" variant="success" @click="submit">Submit</b-btn>
  </div>
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
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/api/compose-term-of-use`)
          .then((response) => {
            this.data = response.data
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit() {
        axios.post(`/api/compose-term-of-use`, {
            data: this.data
          })
          .then((response) => {
            this.toastSuccess(response.data.message)
            console.log(response.data)

          })
          .catch((error) => {
            console.log(error);
          })
      }
    },
  }
</script>
<style>
</style>
