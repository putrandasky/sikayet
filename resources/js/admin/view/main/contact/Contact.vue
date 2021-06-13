<template>
  <b-container class="mt-3">
    <b-card>

      <template #card-title>
        Contact Message
      </template>
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
          </b-table>
        </div>
      </div>
      <b-alert show v-if="isLoaded && itemsData.length == 0">
        <h4>No Contact Data</h4>
        <hr>
        <div>
          The submission from contact will be shown here
        </div>
      </b-alert>

    </b-card>
  </b-container>
</template>
<script>
  import {
    FieldTableData
  } from "./ContactFieldTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  export default {
    components: {},
    name: 'Contact',
    mixins: [FieldTableData, instantSearch, OperationPage],

    data: function() {
      return {
        isLoaded: false,

      }
    },
    mounted() {
      this.getData()
    },
    methods: {

      getData() {
        axios.get(`/api/contact`)
          .then((response) => {
            this.isLoaded = true
            console.log(response.data)
            this.itemsData = response.data
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
