<template>
  <div>
    <h3>My Account</h3>
    <b-row>
      <b-col md="6">
        <b-form-group label="Website URL">
          <b-form-input type="text" v-model="input.website"></b-form-input>
        </b-form-group>

        <b-form-group label="Facebook URL">
          <b-form-input type="text" v-model="input.facebook_url"></b-form-input>
        </b-form-group>
        <b-form-group label="Twitter URL">
          <b-form-input type="text" v-model="input.twitter_url"></b-form-input>
        </b-form-group>
        <b-form-group label="Linkedin URL">
          <b-form-input type="text" v-model="input.linkedin_url"></b-form-input>
        </b-form-group>
        <b-form-group label="Instagram URL">
          <b-form-input type="text" v-model="input.instagram_url"></b-form-input>
        </b-form-group>

      </b-col>
      <b-col md="6">
        <b-form-group label="Email">
          <b-form-input disabled type="text" v-model="input.email"></b-form-input>
        </b-form-group>

        <b-form-group label="Profile">
          <b-form-textarea v-model="input.profile" rows="6"></b-form-textarea>
        </b-form-group>
        <b-form-group label="Business Category">

          <b-form-select plain v-model="input.business_category_id" :options="options.business_category">
            <template slot="first">
              <option disabled :value="null">-- Please Select Business Category --</option>
            </template>
          </b-form-select>
        </b-form-group>
      </b-col>
      <b-col cols="12">

        <b-btn class="mt-3 float-right" variant="primary" @click="updateData">Update Account</b-btn>
      </b-col>

    </b-row>
  </div>
</template>
<script>
  export default {
    name: 'CompanyDashboardMyAccount',
    props: ['companydata', 'business_category'],
    data: function() {
      return {
        maxFileSize: 2048,
        options: {
          business_category: []
        },
        input: {
          profile: '',
          website: '',
          business_category_id: null,
          email: '',
          facebook_url: '',
          twitter_url: '',
          linkedin_url: '',
          instagram_url: '',
        },
      }
    },
    mounted() {

      this.input = this.companydata
      this.options.business_category = this.mutateKey(this.business_category)
    },
    methods: {

      updateData() {
        const {
          profile,
          website,
          business_category_id,
          email,
          facebook_url,
          twitter_url,
          linkedin_url,
          instagram_url,
        } = this.input
        let data = {
          profile: profile,
          website: website,
          business_category_id: business_category_id,
          email: email,
          facebook_url: facebook_url,
          twitter_url: twitter_url,
          linkedin_url: linkedin_url,
          instagram_url: instagram_url,
        }
        axios.post(`/company-dashboard/profile`, data)
          .then((response) => {
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          return {
            value: item.id,
            text: item.range || item.name || item.description,
            state: false
          };
        });
        return mutateData;
      },
    }
  }
</script>
<style>
</style>
