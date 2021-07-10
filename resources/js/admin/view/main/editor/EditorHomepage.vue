<template>
  <div>

    <b-form-group label="Header Title ">
      <b-form-input v-model="data.header_title">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Header Subtitle ">
      <b-form-input v-model="data.header_subtitle">
      </b-form-input>
    </b-form-group>

    <b-btn class="float-right" size="sm" variant="success" @click="submit">Submit</b-btn>
  </div>
</template>
<script>
  export default {
    name: 'EditorHomepage',
    data: function() {
      return {
        data: {
          header_title: '',
          header_subtitle: '',
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/api/compose-header`)
          .then((response) => {
            // this.data = response.data
            let items = response.data
            for (let key in items) {

              this.data[items[key].key] = items[key].value
            }
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit() {
        axios.post(`/api/compose-header`, {
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
