<template>
  <div class="position-relative">
    <b-overlay variant="dark" bg-color="dark" :show="!isLoaded" blur=""></b-overlay>

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
          <template v-slot:cell(payment_status)="data">
            <b-badge :variant="getBadgePaymentStatus(data.item.payment_status)" class="p-1">
              {{ data.item.payment_status }}
            </b-badge>
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeActive(data.item.status)" class="p-1">
              <span v-if="data.item.status == 1">ACTIVE</span>
              <span v-if="data.item.status == 0">UNACTIVE</span> </b-badge>
          </template>
          <template v-slot:cell(action)="data">
            <b-btn size="sm" variant="success" @click="showUserModal(data.item,data.index)">Edit</b-btn>
          </template>
          <template v-slot:cell(amount)="data">
            $ {{data.item.amount}}
          </template>
          <template v-slot:cell(date_invoice)="data">
            {{data.item.date_invoice | dateFormated}}
          </template>
          <template v-slot:cell(date_payment)="data">
            {{data.item.date_payment | dateFormated}}
          </template>
        </b-table>
      </div>
      <b-modal v-model="isUsersModalShow" title="User Data" @ok.prevent="submit">
        <b-form-group label="Name">
          <b-form-input disabled v-model="selected.name"></b-form-input>
        </b-form-group>

        <b-form-group label="Payment Status">

          <b-form-select plain v-model="selected.payment_status" :options="options.payment_statuses">
            <template slot="first">
              <option :value="null" disabled>-- Please Select Payment Status --</option>
            </template>
          </b-form-select>
        </b-form-group>
        <b-form-group label="Subscription Status">

          <b-form-select plain v-model="selected.status" :options="options.statuses">
            <template slot="first">
              <option :value="null" disabled>-- Please Select Subscription Status --</option>
            </template>
          </b-form-select>
        </b-form-group>
      </b-modal>
      <b-alert show v-if="isLoaded && itemsData.length == 0">
        <h4>No Billing Data</h4>
        <hr>
        <div>
          The billing status will be shown here
        </div>
      </b-alert>

    </div>
  </div>
</template>
<script>
  import {
    FieldTableData
  } from "./BillingTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  export default {
    name: 'Billing',
    mixins: [FieldTableData, instantSearch, OperationPage],

    data: function() {
      return {
        isLoaded: false,
        isUsersModalShow: false,
        selectedIndex: null,
        selected: {
          id: null,
          name: '',
          email: '',
          user_status_id: null
        },
        options: {
          payment_statuses: [{
              value: 'UNPAID',
              text: 'UNPAID'
            },
            {
              value: 'PAID',
              text: 'PAID'
            }
          ],
          statuses: [{
              value: 0,
              text: 'UNACTIVE'
            },
            {
              value: 1,
              text: 'ACTIVE'
            },
          ]
        },
      }
    },
    mounted() {
      this.getData()
    },
    watch: {
      '$route.params.condition': "getData"

    },
    methods: {
      showUserModal(value, index) {
        this.isUsersModalShow = true
        this.selected.payment_status = value.payment_status
        this.selected.status = value.status
        this.selected.id = value.id
        this.selected.name = value.company.name
        // this.selected.email = value.email
        // this.selectedIndex = index
        // console.log(getIndex);
      },
      submit() {

        let indexItemsData = this.itemsData.findIndex(a => a.id == this.selected.id)

        axios.patch(`/api/billing/${this.selected.id}`, {
            status: this.selected.status,
            payment_status: this.selected.payment_status,
          })
          .then((response) => {
            this.itemsData[indexItemsData].status = this.selected.status
            this.itemsData[indexItemsData].payment_status = this.selected.payment_status
            this.isUsersModalShow = false
            this.toastSuccess(response.data.message)
            // console.log(this.itemsData[this.selectedIndex])
          })
          .catch((error) => {
            console.log(error);
          })
      },
      getData() {
        this.isLoaded = false
        axios.get(`/api/billings/${this.$route.params.condition}`)
          .then((response) => {
            console.log(response.data)
            this.isLoaded = true
            this.itemsData = response.data.billings
          })
          .catch((error) => {
            console.log(error);
          })
      },

    },
  }
</script>
<style>
</style>
