<template>
  <b-modal class="position-relative" no-close-on-backdrop no-close-on-esc hide-header-close v-model="isModalShow" :busy="isLoading" title="Company Data" @hidden="modalShow(false)" @show="show" @ok.prevent="submit">
    <b-form-group label="Name">
      <b-form-input disabled v-model="data.name"></b-form-input>
    </b-form-group>
    <b-form-group label="Email">
      <b-form-input disabled v-model="data.email"></b-form-input>
    </b-form-group>
    <b-form-group label="Is Verified?">

      <b-form-select plain v-model="data.is_verified" :options="options.is_verified">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Company Verification --</option>
        </template>
      </b-form-select>
    </b-form-group>
    <b-form-group label="Status">

      <b-form-select plain v-model="data.account_status_id" :options="options.company_status">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Company Status --</option>
        </template>
      </b-form-select>
    </b-form-group>

    <b-overlay rounded="sm" variant="light" :show="isLoading" blur="" no-wrap></b-overlay>

  </b-modal>
</template>
<script>
  export default {
    name: 'CompaniesModal',
    props: ['propsData', 'propsOptions'],
    data: function() {
      return {
        isLoading: false,
        data: {
          id: null,
          index: null,
          name: '',
          email: '',
          account_status_id: null,
          is_verified: null,
        },
        isModalShow: false,
        options: {
          is_verified: [{
              value: 0,
              text: 'Unverified'
            },
            {
              value: 1,
              text: 'Verified'
            }
          ],
          company_status: []
        },
      }
    },
    mounted() {
      this.options.company_status = this.propsOptions
      console.log('aaa');
      console.log(this.propsOptions);
    },
    watch: {
      'propsOptions': function(newData, oldData) {
        this.options.company_status = newData
      },
      // 'propsData.index': function(newData, oldData) {
      //   this.data.index = newData
      // },
      // 'propsData.email': function(newData, oldData) {
      //   this.data.email = newData
      // },
      // 'propsData.verified': function(newData, oldData) {
      //   this.data.verified = newData
      // },
      // 'propsData.status': function(newData, oldData) {
      //   this.data.status = newData
      // },
      // 'modalShow': function(newData, oldData) {
      //   this.isModalShow = newData
      // },
    },
    methods: {
      show() {
        this.data.id = this.propsData.id
        this.data.name = this.propsData.name
        this.data.index = this.propsData.index
        this.data.email = this.propsData.email
        this.data.is_verified = this.propsData.is_verified
        this.data.account_status_id = this.propsData.account_status_id
        console.log(this.propsData.is_verified);
      },
      modalShow(value) {
        this.isModalShow = value
      },
      submit() {
        this.$emit('submitted', this.data)
        // let data = {
        //   id: null,
        //   index: null,
        //   name: '',
        //   email: '',
        //   account_status_id: null,
        //   is_verified: null,
        // }

        // this.data = data
      }
    },
  }
</script>
<style>
</style>
