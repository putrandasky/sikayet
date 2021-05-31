<template>
  <b-modal v-model="isModalShow" title="User Data" @hidden="modalShow(false)" @show="show" @ok="submit">
    <b-form-group label="Name">
      <b-form-input disabled v-model="data.name"></b-form-input>
    </b-form-group>
    <b-form-group label="Company">
      <b-form-input disabled v-model="data.company"></b-form-input>
    </b-form-group>
    <b-form-group label="Title">
      <b-form-input disabled v-model="data.title"></b-form-input>
    </b-form-group>
    <b-form-group label="Review">
      <b-form-textarea disabled v-model="data.description"></b-form-textarea>
    </b-form-group>
    <b-form-group label="Review Rating">
      <b-form-rating class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="data.rating"></b-form-rating>
    </b-form-group>
    <b-form-group label="Status">

      <b-form-select plain v-model="data.status" :options="options.review_status">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Review Status --</option>
        </template>
      </b-form-select>
    </b-form-group>
  </b-modal>
</template>
<script>
  export default {
    name: 'ReviewsModal',
    props: ['propsData'],
    data: function() {
      return {
        data: {
          index: null,
          name: '',
          company: '',
          title: '',
          description: '',
          rating: null,
          status: ''
        },
        isModalShow: false,
        options: {

          review_status: [{
              value: 'UNAPPROVED',
              text: 'UNAPPROVED'
            },
            {
              value: 'APPROVED',
              text: 'APPROVED'
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
        this.data.index = this.propsData.index
        this.data.name = this.propsData.name
        this.data.status = this.propsData.status
        this.data.company = this.propsData.company
        this.data.title = this.propsData.title
        this.data.description = this.propsData.description
        this.data.rating = this.propsData.rating
      },
      modalShow(value) {
        this.isModalShow = value
      },
      submit() {
        this.$emit('submitted', this.data)
        let data = {
          index: null,
          name: '',
          company: '',
          title: '',
          description: '',
          rating: null,
          status: ''
        }

        this.data = data
      }
    },
  }
</script>
<style>
</style>
