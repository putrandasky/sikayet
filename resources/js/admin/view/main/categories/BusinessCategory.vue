<template>
  <b-container class="py-3">
    <b-row>
      <b-col md="4" class="mb-3">
        <b-card title="New Category">
          <b-form-group :invalid-feedback="errors.category_name" :state="stateName">
            <b-form-input v-model="input.category_name" :state="stateName">
            </b-form-input>
          </b-form-group>
          <b-btn variant="success" size="sm" class="float-right" @click="postData">Submit</b-btn>
        </b-card>
      </b-col>
      <b-col>
        <b-card title="Business Category List">
          <b-overlay variant="light" bg-color="dark" :show="!isLoaded" blur=""></b-overlay>

          <div v-if="isLoaded && itemsData.length > 0">

            <div>
              <b-row>
                <b-col lg="6" class="mb-3">
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
                <b-col lg="6" style="overflow-y:auto" v-if="getTotalPages > 1">
                  <b-pagination-nav align="right" class="justify-content-end mb-0" :use-router="true" :link-gen="linkGen" :number-of-pages="getTotalPages" v-model="currentPage" />
                </b-col>
              </b-row>
            </div>
            <div style="overflow-y:auto">
              <b-table small :fields="FieldTableItems" :items="filteredItemsData" :sort-by.sync="querySortBy" :sort-desc.sync="querySortDesc" @sort-changed="sortingChanged" :current-page="currentPage" :per-page="perPage">
                <template v-slot:cell(no)="data">
                  {{ data.index + 1 + (currentPage - 1) * perPage }}
                </template>
                <template v-slot:cell(action)="data">
                  <div v-if="data.item.id != 0">

                    <b-btn size="sm" variant="success" @click="openModal(data.item,data.index,'edit')"><i class="fa fa-edit"></i></b-btn>
                    <b-btn size="sm" variant="danger" @click="openModal(data.item,data.index,'delete')"><i class="fa fa-trash"></i></b-btn>
                  </div>
                </template>
              </b-table>
              <!-- <reviews-modal ref="reviewsModal" :propsData="selected" :propsOptions="options.review_statuses" @submitted="submit($event)" /> -->
            </div>
          </div>
          <b-alert show v-if="isLoaded && itemsData.length == 0">
            <h4>No Business Category Data</h4>
            <hr>
            <div>
              The Business Category will be shown here
            </div>
          </b-alert>
        </b-card>
      </b-col>
    </b-row>
    <b-modal @ok="updateData" @cancel="editModalOpen = false" v-model="editModalOpen" title="Update Category Name" no-close-on-esc no-close-on-backdrop hide-header-close>
      <b-form-group :invalid-feedback="errors_update.category_name" :state="stateUpdateName">
        <b-form-input v-model="input_update.category_name" :state="stateUpdateName">
        </b-form-input>
      </b-form-group>
    </b-modal>
    <confirmation-modal ref="deleteConfirmationModal" title="Delete Business Category" @ok="deleteData">
      <template #body>
        Are you sure want to delete this business category name? All related brands to this category name will be set category name to uncategorized
      </template>
    </confirmation-modal>
  </b-container>
</template>
<script>
  import {
    FieldTableData
  } from "./BusinessCategoryFieldTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  import ConfirmationModal from '../../../components/modals/ConfirmationModal.vue'
  export default {
    name: 'BusinessCategory',
    mixins: [FieldTableData, instantSearch, OperationPage],
    components: {
      ConfirmationModal
    },
    data: function() {
      return {
        isLoaded: false,
        editModalOpen: false,
        deleteConfirmationModalOpen: false,
        index: null,
        input_update: {
          category_name: '',
          category_id: null
        },
        errors_update: {
          category_name: ''
        },
        input: {
          category_name: ''
        },
        errors: {
          category_name: ''
        }
      }
    },
    mounted() {
      this.getData()
    },
    computed: {

      stateName() {
        return this.errors.category_name == 'no-error' ? true : this.errors.category_name ? false : null
      },
      stateUpdateName() {
        return this.errors_update.category_name == 'no-error' ? true : this.errors_update.category_name ? false : null
      },
    },
    methods: {
      openModal(item, index, mode) {
        let indexItemsData = this.itemsData.findIndex(a => a.id == item.id)
        console.log(item);
        this.input_update.category_name = item.name
        this.input_update.category_id = item.id
        this.index = indexItemsData
        if (mode == 'edit') {
          this.editModalOpen = true
        }
        if (mode == 'delete') {
          this.$refs.deleteConfirmationModal.openModal = true
        }
      },
      deleteData() {
        axios.delete(`/api/business-category/${this.input_update.category_id}`)
          .then((response) => {
            console.log(response.data)
            this.toastSuccess(response.data.message)

            this.itemsData.splice(this.index, 1)
            this.$refs.deleteConfirmationModal.openModal = false

          })
          .catch((error) => {
            console.log(error);
          })
      },
      updateData(e) {
        e.preventDefault()
        axios.patch(`/api/business-category`, this.input_update)
          .then((response) => {
            console.log(response.data)
            this.toastSuccess(response.data.message)
            console.log(this.itemsData[this.index].name);
            this.itemsData[this.index].name = this.input_update.category_name
            this.input_update.category_name = ''
            // this.getData()
            this.editModalOpen = false
          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.errors_update.category_name = errors.category_name ? errors.category_name[0] : 'no-error';

          })
      },
      postData() {

        axios.post(`/api/business-category`, this.input)
          .then((response) => {
            console.log(response.data)
            this.input.category_name = ''
            this.toastSuccess(response.data.message)
            this.getData()
          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.errors.category_name = errors.category_name ? errors.category_name[0] : 'no-error';

          })
      },
      getData() {
        this.isLoaded = false

        axios.get(`/api/business-category`)
          .then((response) => {
            console.log(response.data)
            this.itemsData = response.data
            this.isLoaded = true

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
