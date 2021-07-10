<template>
  <div>

    <b-form-group label="Url for Facebook ">
      <b-form-input v-model="data.social_facebook" placeholder="Begin with https://">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Url for Facebook ">
      <b-form-input v-model="data.social_instagram" placeholder="Begin with https://">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Url for Facebook ">
      <b-form-input v-model="data.social_twitter" placeholder="Begin with https://">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Url for Facebook ">
      <b-form-input v-model="data.social_linkedin" placeholder="Begin with https://">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Url for Email ">
      <b-form-input v-model="data.social_email">
      </b-form-input>
    </b-form-group>
    <b-btn class="float-right" size="sm" variant="success" @click="submit">Submit</b-btn>
  </div>
</template>
<script>
  export default {
    name: 'EditorSocial',
    data: function() {
      return {
        data: {
          social_facebook: '',
          social_instagram: '',
          social_twitter: '',
          social_linkedin: '',
          social_email: '',
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/api/compose-social`)
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
        axios.post(`/api/compose-social`, {
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
