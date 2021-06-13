<template>
  <div>
    <h4>Main Info</h4>
    <b-form-group label="Header Title">
      <b-form-input v-model="data.about_header_title">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Header SubTitle">
      <b-form-input v-model="data.about_header_subtitle">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Header Subheader">
      <b-form-input v-model="data.about_subheader">
      </b-form-input>
    </b-form-group>
    <b-form-group label="Header Subheader">
      <b-form-input v-model="data.about_image_info">
      </b-form-input>
    </b-form-group>

    <hr>
    <h4>Benefits</h4>
    <b-row>
      <b-col md="6">
        <b-form-group label="#1 Icon ">
          <b-form-input v-model="data.about_benefit1_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#1 Title ">
          <b-form-input v-model="data.about_benefit1_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#1 Subtitle ">
          <b-form-input v-model="data.about_benefit1_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#2 Icon ">
          <b-form-input v-model="data.about_benefit2_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#2 Title ">
          <b-form-input v-model="data.about_benefit2_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#2 Subtitle ">
          <b-form-input v-model="data.about_benefit2_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#3 Icon ">
          <b-form-input v-model="data.about_benefit3_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#3 Title ">
          <b-form-input v-model="data.about_benefit3_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#3 Subtitle ">
          <b-form-input v-model="data.about_benefit3_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>


    </b-row>
    <hr>
    <h4>Features</h4>
    <b-row>
      <b-col md="6">
        <b-form-group label="#1 Icon ">
          <b-form-input v-model="data.about_feature1_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#1 Title ">
          <b-form-input v-model="data.about_feature1_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#1 Subtitle ">
          <b-form-input v-model="data.about_feature1_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#2 Icon ">
          <b-form-input v-model="data.about_feature2_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#2 Title ">
          <b-form-input v-model="data.about_feature2_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#2 Subtitle ">
          <b-form-input v-model="data.about_feature2_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#3 Icon ">
          <b-form-input v-model="data.about_feature3_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#3 Title ">
          <b-form-input v-model="data.about_feature3_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#3 Subtitle ">
          <b-form-input v-model="data.about_feature3_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#4 Icon ">
          <b-form-input v-model="data.about_feature4_icon">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="6">
        <b-form-group label="#4 Title ">
          <b-form-input v-model="data.about_feature4_title">
          </b-form-input>
        </b-form-group>
      </b-col>
      <b-col md="12">
        <b-form-group label="#4 Subtitle ">
          <b-form-input v-model="data.about_feature4_subtitle">
          </b-form-input>
        </b-form-group>
      </b-col>


    </b-row>
    <b-btn variant="success" class="mt-3" size="sm" @click="submit">Submit</b-btn>
  </div>
</template>
<script>
  export default {
    name: 'EditorAbout',
    data: function() {
      return {
        data: {
          about_header_title: '',
          about_header_subtitle: '',
          about_subheader: '',
          about_image_info: '',
          about_benefit1_icon: '',
          about_benefit1_title: '',
          about_benefit1_subtitle: '',
          about_benefit2_icon: '',
          about_benefit2_title: '',
          about_benefit2_subtitle: '',
          about_benefit3_icon: '',
          about_benefit3_title: '',
          about_benefit3_subtitle: '',
          about_feature1_icon: '',
          about_feature1_title: '',
          about_feature1_subtitle: '',
          about_feature2_icon: '',
          about_feature2_title: '',
          about_feature2_subtitle: '',
          about_feature3_icon: '',
          about_feature3_title: '',
          about_feature3_subtitle: '',
          about_feature4_icon: '',
          about_feature4_title: '',
          about_feature4_subtitle: '',
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/api/compose-about`)
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
        axios.post(`/api/compose-about`, {
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
