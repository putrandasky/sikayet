<template>
  <div style="min-height:100px">
    <h3 class="mb-3">Company Reviews</h3>
    <div v-if="isLoaded && itemsData.length > 0">
      <b-row v-show="!detailMode">
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
          <b-pagination align="right" class="justify-content-end mb-0" :total-rows="getTotalRows" v-model="currentPage" />
        </b-col>
      </b-row>
      <div v-show="!detailMode" style="overflow:auto">

        <b-table small stacked="sm" :fields="FieldTableItems" :items="filteredItemsData" :current-page="currentPage" :per-page="perPage">
          <template v-slot:cell(no)="data">
            {{data.index+1}}
            <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
          </template>
          <template v-slot:cell(from)="data">
            {{data.item.user.name}}
          </template>
          <template v-slot:cell(review_title)="data">
            {{data.item.title}}
          </template>
          <template v-slot:cell(rating)="data">
            <div class="w-100">
              <i v-for="v in data.item.rating" :key="v" class="fa fa-star"></i>
            </div>
            {{data.item.rating}} / 5
          </template>
          <template v-slot:cell(type)="data">
            <b-badge :variant="getBadgeReviewType(data.item.review_type.name)" class="p-1">
              {{ data.item.review_type.name }}
            </b-badge>
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.review_status.name )" class="p-1">
              {{ data.item.review_status.name }}
            </b-badge>
          </template>
          <template v-slot:cell(answered)="data">
            <b-badge v-if="data.item.company_respond" variant="success">
              <i class="fa fa-check"></i>
            </b-badge>
            <b-badge v-if="!data.item.company_respond" variant="danger">
              <i class="fa fa-close"></i>
            </b-badge>
          </template>
          <template v-slot:cell(created_at)="data">
            {{data.item.created_at | dateFormated}}
          </template>
          <template v-slot:cell(action)="data">
            <b-btn variant="success" size="sm" @click="editMode(data.item.id)">
              See Review
            </b-btn>
          </template>
        </b-table>
      </div>
      <div v-show="detailMode">

        <b-container>
          <b-row class=" justify-content-center">
            <b-col md="8" lg="6">
              <div class="d-flex justify-content-between">

                <b-btn variant="secondary" class="mb-3" size="sm" @click="detailMode = false"><i class="fa fa-arrow-left"></i> Back</b-btn>
                <div>
                  <b-btn v-if="!reportStatus" variant="danger" class="mb-3" size="sm" @click="report"><i class="fa fa-exclamation"></i> Report</b-btn>
                  <b-btn v-if="reportStatus" disabled variant="outline-secondary" class="mb-3" size="sm" @click="report"><i class="fa fa-check"></i> Reported</b-btn>
                </div>
              </div>
              <div class=" d-block ">
                <h4>
                  {{detail.title}}
                </h4>
              </div>
              <div class="d-flex mb-3 justify-content-between">
                <div class="d-flex">
                  <div v-for="i in detail.rating" :key="'green'+i" class="bg-success rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
                  <div v-for="i in (5 - detail.rating)" :key="i" class="bg-secondary rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
                </div>
                <div class="text-muted">
                  <em>{{detail.created_at | dateFormated}}</em>
                </div>
              </div>
              <b-row class="">
                <b-col cols="12" class="mb-md-0 mb-3">
                  <div class="float-left mr-3 ">
                    <b-img class="rounded rounded-circle img-fluid" src="images/websites/avatar1.jpg" alt="" style="width: 50px;heigh:auto"></b-img>
                  </div>
                  <div class="mt-2 ">
                    {{detail.user.name}}
                  </div>
                </b-col>
                <b-col cols="12" class="pt-3">
                  <p>
                    {{detail.description}}
                  </p>
                </b-col>
              </b-row>
              <div v-if="!respondData">
                <b-form-textarea placeholder="Reply Your User Review" v-model="respond" rows="4"></b-form-textarea>
                <b-btn variant="primary" size="sm" class="float-right mt-3" @click="sendData">Reply</b-btn>
              </div>
              <div class="border-left ml-3 pl-3" v-if="respondData">
                <div class="d-flex mb-3 justify-content-between w-100">
                  <div class="d-flex">
                    Replied from you
                  </div>
                  <div class="text-muted">
                    <em>{{detail.company_respond.created_at | dateFormated}}</em>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="float-left mr-3 ">
                    <b-avatar></b-avatar>
                    <!-- <b-img class="rounded rounded-circle img-fluid" src="images/websites/avatar1.jpg" alt="" style="width: 50px;heigh:auto"></b-img> -->
                  </div>
                  <div class="mt-2 ">
                    {{detail.company_respond.company.name}}
                  </div>
                </div>
                <div class="pt-3">
                  <p>
                    {{detail.company_respond.description}}
                  </p>
                </div>
              </div>
            </b-col>

          </b-row>

        </b-container>
      </div>

    </div>
    <b-alert show v-if="isLoaded && itemsData.length == 0">
      <h4>No Review Data</h4>
      <hr>
      <div>
        Your review from users will be shown here
      </div>
    </b-alert>
    <b-overlay variant="dark" :show="!isLoaded" blur=""></b-overlay>

  </div>
</template>
<script>
  import {
    EventBus
  } from "../event.js";
  import {
    Badge
  } from "../mixins/MixinBadge";
  import {
    MyReviewTable
  } from "./CompanyDashboardMyReviewTable"
  import {
    instantSearch
  } from "../mixins/instantSearch";
  import {
    OperationPage
  } from "../mixins/OperationPage";
  export default {
    name: 'CompanyDashboardMyReview',
    mixins: [Badge, MyReviewTable, instantSearch, OperationPage],

    data: function() {
      return {
        isLoaded: false,
        detailMode: false,
        respond: '',
        detail: {
          index: null,
          title: '',
          rating: null,
          description: '',
          user: {
            name: ''
          },
          company_respond: null,
          reported: 0,
          created_at: "",

        },
        items: [{}]
      }
    },
    mounted() {
      this.getData()
    },
    computed: {
      respondData() {
        return this.detail.company_respond
      },
      reportStatus() {
        return this.detail.reported
      }
    },
    methods: {
      getFirstChar(name) {

        return this.$options.filters.ucfirst(name);
      },
      getData() {
        let self = this
        axios.get(`/company-dashboard/review`)
          .then((response) => {
            console.log(response.data)
            this.itemsData = response.data.reviews
            this.isLoaded = true
            EventBus.$emit('initReviewsSummary', respond.data.review)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      editMode(id) {
        let i = this.itemsData.findIndex(a => a.id == id)

        this.detail.index = i
        this.detail.id = this.itemsData[i].id
        this.detail.title = this.itemsData[i].title
        this.detail.user = this.itemsData[i].user
        this.detail.created_at = this.itemsData[i].created_at
        this.detail.rating = this.itemsData[i].rating
        this.detail.description = this.itemsData[i].description
        this.detail.reported = this.itemsData[i].reported
        this.detail.company_respond = this.itemsData[i].company_respond
        this.detailMode = true
      },
      report() {
        axios.post(`/company-dashboard/report-review/${this.detail.id}`)
          .then((response) => {
            console.log(response.data)
            this.detail.reported = 1
            this.itemsData[this.detail.index].reported = 1
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      sendData() {
        let self = this
        axios.post(`/company-dashboard/respond-review`, {
            respond: this.respond,
            review_id: this.detail.id,
          })
          .then((response) => {
            console.log(response.data)
            self.respond = ''
            self.itemsData[this.detail.index].company_respond = response.data.data
            self.detail.company_respond = response.data.data
            console.log(self.detail.company_respond);
            this.toastSuccess(response.data.message)

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
