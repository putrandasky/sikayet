<template>
  <div>
    <b-overlay variant="light" bg-color="dark" :show="!isLoaded" blur=""></b-overlay>

    <div v-if="isLoaded && itemsData.length > 0">

      <div>
        <b-row>
          <b-col xl="4" md="6" class="mb-3">
            <b-input-group>
              <b-input-group-prepend>
                <b-form-select plain v-model="selectedInputSearch" :options="optionsInputSearch" />
              </b-input-group-prepend>
              <b-form-input autofocus v-model="search" @input="onInput" type="text" placeholder="Instant Search">
              </b-form-input>
              <b-input-group-append>
                <b-btn :disabled="!search" @click="search = ''">Clear</b-btn>
              </b-input-group-append>
            </b-input-group>
          </b-col>
          <b-col xl="8" md="6" style="overflow-y:auto" v-if="getTotalPages > 1">
            <b-pagination-nav align="right" class="justify-content-end mb-0" :use-router="true" :link-gen="linkGen" :number-of-pages="getTotalPages" v-model="currentPage" />
          </b-col>
        </b-row>
      </div>
      <div style="overflow-y:auto">
        <b-table small stacked="sm" :fields="FieldTableItems" :items="filteredItemsData" :sort-by.sync="querySortBy" :sort-desc.sync="querySortDesc" @sort-changed="sortingChanged" :current-page="currentPage" :per-page="perPage">
          <template v-slot:cell(no)="data">
            {{ data.index + 1 + (currentPage - 1) * perPage }}
          </template>
          <template v-slot:cell(verified)="data">
            <b-badge v-if="data.item.is_verified" variant="success">
              <i class="fa fa-check"></i>
            </b-badge>
            <b-badge v-if="!data.item.is_verified" variant="danger">
              <i class="fa fa-close"></i>
            </b-badge>
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.account_status.name)" class="p-1">
              {{ data.item.account_status.name }}
            </b-badge>
          </template>
          <template v-slot:cell(created_at)="data">
            {{data.item.created_at | dateFormated}}
          </template>

          <template v-slot:cell(action)="data">
            <div class="d-flex">
              <b-btn size="sm" variant="success" @click="edit(data.item,data.index)"><i class="fa fa-edit"></i></b-btn>
              <b-btn class="ml-1" size="sm" variant="secondary" @click="openComppanyPage(data.item.slug)"><i class="fa fa-external-link"></i></b-btn>
            </div>
          </template>
        </b-table>
        <companies-modal ref="companiesModal" :propsData="selected" :propsOptions="options.account_statuses" :modalShow="isCompanyModalShow" @submitted="submit($event)" />
      </div>
    </div>
    <b-alert show v-if="isLoaded && itemsData.length == 0">
      <h4>No Company Data</h4>
      <hr>
      <div>
        The company with UNACTIVE status will be shown here
      </div>
    </b-alert>

  </div>
</template>
<script>
  import CompaniesModal from './CompaniesModal.vue'
  import {
    FieldTableData
  } from "./CompaniesUnverifiedFieldTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  export default {
    components: {
      CompaniesModal
    },
    name: 'CompaniesUnverified',
    mixins: [FieldTableData, instantSearch, OperationPage],

    data: function() {
      return {
        isLoaded: false,
        isCompanyModalShow: false,
        options: {
          account_statuses: []
        },
        selected: {
          index: null,
          name: '',
          email: '',
          verified: null,
          status: ''
        },

        // data: [{
        //     id: 1,
        //     name: 'Newbie Company',
        //     email: 'newbie_company@mail.com',
        //     verified: false,
        //     created_at: '21-Jun-21',
        //     status: 'UNACTIVE',
        //   },
        //   {
        //     id: 1,
        //     name: 'novice Company',
        //     email: 'novice_company@mail.com',
        //     verified: false,
        //     status: 'UNACTIVE',
        //     created_at: '21-Jun-21'
        //   },
        // ]
      }
    },
    mounted() {
      // this.getData()
    },
    methods: {
      edit(value, index) {
        console.log(value, index);
        this.selected.id = value.id
        this.selected.account_status_id = value.account_status_id
        this.selected.name = value.name
        this.selected.email = value.email
        this.selected.is_verified = value.is_verified
        this.$nextTick(() => {
          this.$refs.companiesModal.modalShow(true)
        });

      },
      getData() {
        axios.get(`/api/companies/unactive`)
          .then((response) => {
            this.isLoaded = true
            console.log(response.data)
            this.itemsData = response.data.companies
            this.options.account_statuses = this.mutateKey(response.data.account_statuses)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit(e) {
        this.$refs.companiesModal.isLoading = true
        let newData = this.options.account_statuses.find(
          data => data.value == e.account_status_id
        )
        let new_accout_status = {
          id: newData.value,
          name: newData.text,
        }
        let indexItemsData = this.itemsData.findIndex(a => a.id == e.id)
        axios.patch(`/api/company/${e.id}`, {
            account_status_id: e.account_status_id,
            is_verified: e.is_verified,
          })
          .then((response) => {
            this.$refs.companiesModal.isLoading = false
            this.itemsData[indexItemsData].account_status = new_accout_status
            this.itemsData[indexItemsData].account_status_id = newData.value
            this.itemsData[indexItemsData].is_verified = e.is_verified
            this.$refs.companiesModal.modalShow(false)
            this.toastSuccess(response.data.message)
            // console.log(this.itemsData[this.selectedIndex])
          })
          .catch((error) => {
            this.$refs.companiesModal.isLoading = false
            this.toastError(error.response.data.message)
            console.log(error);
          })

      },
      openComppanyPage(slug) {
        window.open(`/brand/${slug}`)
      },
    },
  }
</script>
<style>
</style>
