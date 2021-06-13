<template>
  <div>
    <strong>Compose Privacy Policy</strong>
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
    name: 'EditorPrivacyPolicy',
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
        axios.get(`/api/compose-privacy-policy`)
          .then((response) => {
            this.data = response.data
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit() {
        axios.post(`/api/compose-privacy-policy`, {
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
