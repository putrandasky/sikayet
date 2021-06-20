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
              <b-form-input v-if="selectedInputSearch != 'date'" autofocus v-model="search" @input="onInput" type="text" placeholder="Instant Search">
              </b-form-input>
              <b-form-datepicker v-if="selectedInputSearch == 'date'" v-model="search" @input="onInput"></b-form-datepicker>
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
          <template v-slot:cell(review_type)="data">
            <b-badge :variant="getBadgeReviewType(data.item.review_type.name)" class="p-1">
              {{ data.item.review_type.name }}
            </b-badge>

          </template>
          <template v-slot:cell(rating)="data">
            <i class="fa fa-star"></i> {{data.item.rating}}
          </template>

          <template v-slot:cell(review_status)="data">
            <b-badge :variant="getBadgeReviewStatus(data.item.review_status.name)" class="p-1">
              {{data.item.review_status.name}}
            </b-badge>
          </template>
          <template v-slot:cell(created_at)="data">
            {{data.item.created_at | dateFormated}}
          </template>
          <template v-slot:cell(action)="data">
            <b-btn v-if="data.item.review_status.name !== 'PUBLISHED'" size="sm" variant="success" @click="edit(data.item,data.index)">Edit</b-btn>
          </template>
        </b-table>
        <reviews-modal :orphansMode="true" ref="reviewsModal" :propsData="selected" :propsOptions="options.review_statuses" :businessCategories="options.business_categories" @submitted="submit($event)" />
      </div>
    </div>
    <b-alert show v-if="isLoaded && itemsData.length == 0">
      <h4>No Review Data</h4>
      <hr>
      <div>
        The review with IN REVIEW status will be shown here
      </div>
    </b-alert>

  </div>
</template>
<script>
  import ReviewsModal from './ReviewsModal.vue';
  import {
    FieldTableData
  } from "./ReviewsOrphansFieldTable"
  import {
    instantSearch
  } from "../../../utils/instantSearch";
  import {
    OperationPage
  } from "../../../utils/OperationPage";
  export default {
    components: {
      ReviewsModal
    },
    name: 'ReviewsNew',
    mixins: [FieldTableData, instantSearch, OperationPage],

    data: function() {
      return {
        isLoaded: false,
        isReviewModalShow: false,
        options: {
          review_statuses: [],
          business_categories: []
        },
        selected: {
          index: null,
          name: '',
          company_name: '',
          title: '',
          photo: null,
          description: '',
          rating: null,
          review_status_id: null
        },
      }
    },
    created() {},
    methods: {
      edit(value, index) {
        console.log(value, index);
        this.selected.review_status_id = value.review_status_id
        this.selected.id = value.id
        this.selected.name = value.user.name
        this.selected.company = value.company_name
        this.selected.title = value.title
        this.selected.photo = value.photo
        this.selected.description = value.description
        this.selected.rating = value.rating
        this.selected.index = index
        this.$nextTick(() => {
          this.$refs.reviewsModal.modalShow(true)
        });

      },
      getData() {
        axios.get(`/api/reviews/orphans`)
          .then((response) => {
            this.isLoaded = true
            console.log(response.data)
            this.itemsData = response.data.reviews.data
            this.options.review_statuses = this.mutateKey(response.data.review_statuses)
            this.options.business_categories = this.mutateKey(response.data.reviews.business_categories)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit(e) {
        let newData = this.options.review_statuses.find(
          data => data.value == 2
        )
        let new_review_status = {
          id: newData.value,
          name: newData.text,
        }
        let indexItemsData = this.itemsData.findIndex(a => a.id == e.id)
        axios.post(`/api/review-orphans`, {
            new_company: e.new_company,
            id: e.id,
          })
          .then((response) => {
            this.itemsData[indexItemsData].review_status = new_review_status
            this.itemsData[indexItemsData].review_status_id = newData.value
            this.$refs.reviewsModal.modalShow(false)
            this.toastSuccess(response.data.message)

            // console.log(this.itemsData[this.selectedIndex])
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
