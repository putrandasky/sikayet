<template>
  <b-container fluid class="py-3">
    <b-card>
      <b-card-title>
        User List
      </b-card-title>
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
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.account_status.name)" class="p-1">
              {{ data.item.account_status.name }}
            </b-badge>
          </template>
          <template v-slot:cell(action)="data">
            <b-btn size="sm" variant="success" @click="showUserModal(data.item,data.index)">Edit</b-btn>
          </template>
          <template v-slot:cell(created_at)="data">
            {{data.item.created_at | dateFormated}}
          </template>
        </b-table>
      </div>
    </b-card>
    <b-modal v-model="isUsersModalShow" title="User Data" @ok.prevent="submit">
      <b-form-group label="Name">
        <b-form-input disabled v-model="selected.name"></b-form-input>
      </b-form-group>
      <b-form-group label="Email">
        <b-form-input disabled v-model="selected.email"></b-form-input>
      </b-form-group>
      <b-form-group label="Status">

        <b-form-select plain v-model="selected.account_status_id" :options="options.account_statuses">
          <template slot="first">
            <option :value="null" disabled>-- Please Select User Status --</option>
          </template>
        </b-form-select>
      </b-form-group>
    </b-modal>
  </b-container>
</template>
<script>
  import {
    FieldTableData
  } from "./UserFieldTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  export default {
    name: 'Users',
    mixins: [FieldTableData, instantSearch, OperationPage],

    data: function() {
      return {
        isUsersModalShow: false,
        selectedIndex: null,
        selected: {
          id: null,
          name: '',
          email: '',
          user_status_id: null
        },
        options: {
          account_statuses: []
        },
        // data: [
        // {
        //   id: 1,
        //   name: 'John Doe',
        //   email: 'john@mail.com',
        //   total_review: 2000,
        //   total_useful: 200,
        //   total_unuseful: 200,
        //   created_at: '21-Jun-21',
        //   status: {
        //     value: 1,
        //     text: 'ACTIVE'
        //   }
        // },
        // {
        //   id: 1,
        //   name: 'Jane Doe',
        //   email: 'jane@mail.com',
        //   total_review: 1000,
        //   total_useful: 22,
        //   total_unuseful: 22,
        //   created_at: '21-Jun-21',
        //   status: {
        //     value: 2,
        //     text: 'SUSPEND'
        //   },
        // },
        // ]
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      showUserModal(value, index) {
        this.isUsersModalShow = true
        this.selected.account_status_id = value.account_status_id
        this.selected.id = value.id
        this.selected.name = value.name
        this.selected.email = value.email
        // this.selectedIndex = index
        // console.log(getIndex);
      },
      submit() {
        let newData = this.options.account_statuses.find(
          data => data.value == this.selected.account_status_id
        )
        console.log(newData);
        let new_accout_status = {
          id: newData.value,
          name: newData.text,
        }
        let indexItemsData = this.itemsData.findIndex(a => a.id == this.selected.id)

        axios.patch(`/api/user/${this.selected.id}`, {
            account_status_id: this.selected.account_status_id
          })
          .then((response) => {
            this.itemsData[indexItemsData].account_status = new_accout_status
            this.itemsData[indexItemsData].account_status_id = newData.value
            this.isUsersModalShow = false
            this.toastSuccess(response.data.message)
            // console.log(this.itemsData[this.selectedIndex])
          })
          .catch((error) => {
            console.log(error);
          })
      },
      getData() {
        axios.get(`/api/users`)
          .then((response) => {
            console.log(response.data)
            this.itemsData = response.data.users
            this.options.account_statuses = this.mutateKey(response.data.account_statuses)
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
