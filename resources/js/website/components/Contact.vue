<template>
  <b-container class="w-100 d-flex align-items-center justify-content-center">
    <b-row class="w-100  justify-content-center">
      <b-col md="8">
        <b-tabs id="tab-contact-form" content-class="mt-3" justified>
          <b-tab>
            <template #title>
              <span class="float-left mr-2">
                <i class="ri-question-fill ri-3x"></i>
              </span>
              <div class="text-left">

                <div><strong>Questions</strong></div>
                <div>Omnis justo gloriatur et sit</div>
              </div>
            </template>
          </b-tab>
          <b-tab @click="handleClick">
            <template #title>
              <span class="float-left mr-2">
                <i class="ri-lifebuoy-fill ri-3x"></i>
              </span>
              <div class="text-left">
                <div><strong>Support</strong></div>
                <div>Omnis justo gloriatur et sit</div>
              </div>
            </template>
          </b-tab>

        </b-tabs>
        <b-card class="rounded-0 border-top-0 mb-3">
          <b-row>
            <b-col md="6">

              <b-form-group>
                <b-input v-model="input.name" type="text" placeholder="Full Name"></b-input>
              </b-form-group>
            </b-col>
            <b-col md="6">
              <b-form-group>
                <b-input v-model="input.email" type="email" placeholder="Email"></b-input>
              </b-form-group>
            </b-col>
            <b-col md="12">
              <b-form-group>
                <b-form-textarea v-model="input.message" type="text" placeholder="Message" rows="6"></b-form-textarea>
              </b-form-group>
            </b-col>
          </b-row>
        </b-card>
        <div class="w-100 text-center">
          <b-btn class="px-5" variant="primary" @click="postData">Submit</b-btn>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
  export default {
    name: 'contact',
    data: function() {
      return {
        input: {
          name: '',
          email: '',
          message: '',
        }
      }
    },
    created() {},
    methods: {
      handleClick() {
        window.open('/faq', '_self')
      },
      postData() {
        axios.post(`/contact`, this.input)
          .then((response) => {
            this.toastSuccess(response.data.message)
            console.log(response.data)
            setTimeout(() => {
              window.open('/', '_self')
            }, 500);
          })
          .catch((error) => {
            console.log(error);
          })
      }
    },
  }
</script>
<style lang="scss">
  #tab-contact-form__BV_tab_controls_ {
    .nav-link {
      height: 100%;
    }
  }

  #tab-contact-form__BV_tab_container_ {
    display: none;


  }
</style>
