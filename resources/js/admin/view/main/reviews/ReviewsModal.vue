<template>
  <b-modal v-model="isModalShow" title="User Data" @hidden="modalShow(false)" @show="show" @ok.prevent="submit">
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
    <b-form-group label="Photo" v-if="data.photo">
      <b-img fluid :src="`/storage/reviewasset/${data.photo}`"></b-img>
    </b-form-group>
    <b-form-group v-if="!orphansMode" label="Status">

      <b-form-select plain v-model="data.review_status_id" :options="options.review_status">
        <template slot="first">
          <option :value="null" disabled>-- Please Select Review Status --</option>
        </template>
      </b-form-select>
    </b-form-group>
    <div v-if="orphansMode">
      <b-form-group label="New Company Name">
        <b-form-input v-model="data.new_company.name" placeholder="Write a proper Company name base on Company name above"></b-form-input>
      </b-form-group>
      <b-form-group label="Company Email">
        <b-form-input v-model="data.new_company.email" placeholder="Input email for login to this Company account"></b-form-input>
      </b-form-group>
      <b-form-group label="Status">

        <b-form-select plain v-model="data.new_company.business_category" :options="options.business_categories">
          <template slot="first">
            <option :value="null">-- Please Select Business Category --</option>
          </template>
        </b-form-select>
      </b-form-group>
      <b-form-group label="Password">
        <b-form-input v-model="data.new_company.password" placeholder="Input password for login to this Company account"></b-form-input>
      </b-form-group>
      <b-form-group label="Password Confirmation">
        <b-form-input v-model="data.new_company.password_confirmation" placeholder="Confirm password above"></b-form-input>
      </b-form-group>
    </div>
  </b-modal>
</template>
<script>
  export default {
    name: 'ReviewsModal',
    props: ['propsData', 'propsOptions', 'orphansMode', 'businessCategories'],
    data: function() {
      return {
        data: {
          id: null,
          index: null,
          name: '',
          company: '',
          title: '',
          photo: null,
          description: '',
          rating: null,
          review_status_id: '',
          new_company: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            business_category: null
          }
        },
        isModalShow: false,
        options: {
          review_status: [],
          business_categories: []
        },
      }
    },
    mounted() {
      this.options.review_status = this.propsOptions
      this.options.business_categories = this.businessCategories
    },
    watch: {},
    methods: {
      show() {
        this.data.id = this.propsData.id
        this.data.index = this.propsData.index
        this.data.name = this.propsData.name
        this.data.review_status_id = this.propsData.review_status_id
        this.data.company = this.propsData.company
        this.data.title = this.propsData.title
        this.data.photo = this.propsData.photo
        this.data.description = this.propsData.description
        this.data.rating = this.propsData.rating
      },
      modalShow(value) {
        this.isModalShow = value
        if (!value) {
          let data = {
            id: null,
            index: null,
            name: '',
            company: '',
            title: '',
            description: '',
            rating: null,
            review_status_id: '',
            new_company: {
              name: '',
              email: '',
              password: '',
              password_confirmation: '',
              business_category: null
            }
          }

          this.data = data
        }
      },
      submit() {
        this.$emit('submitted', this.data)

      },
      closed() {

      }
    },
  }
</script>
<style>
</style>
