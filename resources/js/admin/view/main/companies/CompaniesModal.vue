<template>
  <b-modal v-model="isModalShow" title="User Data" @hidden="modalShow(false)" @show="show" @ok="submit">
    <b-form-group label="Name">
      <b-form-input disabled v-model="data.name"></b-form-input>
    </b-form-group>
    <b-form-group label="Email">
      <b-form-input disabled v-model="data.email"></b-form-input>
    </b-form-group>
    <b-form-group label="Is Verified?">

      <b-form-select plain v-model="data.verified" :options="options.verified">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Company Verification --</option>
        </template>
      </b-form-select>
    </b-form-group>
    <b-form-group label="Status">

      <b-form-select plain v-model="data.status" :options="options.company_status">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Company Status --</option>
        </template>
      </b-form-select>
    </b-form-group>
  </b-modal>
</template>
<script>
  export default {
    name: 'CompaniesModal',
    props: ['propsData'],
    data: function() {
      return {
        data: {
          index: null,
          name: '',
          email: '',
          status: '',
          verified: null,
        },
        isModalShow: false,
        options: {
          verified: [{
              value: false,
              text: 'Unverified'
            },
            {
              value: true,
              text: 'Verified'
            }
          ],
          company_status: [{
              value: 'UNACTIVE',
              text: 'UNACTIVE'
            },
            {
              value: 'ACTIVE',
              text: 'ACTIVE'
            },
            {
              value: 'SUSPENDED',
              text: 'SUSPENDED'
            }
          ]
        },
      }
    },
    created() {},
    watch: {
      // 'propsData.name': function(newData, oldData) {
      //   this.data.name = newData
      // },
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
        this.data.name = this.propsData.name
        this.data.index = this.propsData.index
        this.data.email = this.propsData.email
        this.data.verified = this.propsData.verified
        this.data.status = this.propsData.status
      },
      modalShow(value) {
        this.isModalShow = value
      },
      submit() {
        this.$emit('submitted', this.data)
        let data = {
          index: null,
          name: '',
          email: '',
          status: '',
          verified: null,
        }

        this.data = data
      }
    },
  }
</script>
<style>
</style>
