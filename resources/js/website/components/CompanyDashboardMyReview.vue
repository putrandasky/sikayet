<template>
  <div style="min-height:100px">
    <h3 class="mb-3">Company Reviews</h3>
    <b-overlay variant="dark" :show="!isLoaded" blur=""></b-overlay>

    <div v-if="isLoaded && itemsData.length > 0">
      <b-row v-show="!detailMode">
        <b-col xl="4" md="6" class="mb-3">
          <b-input-group>
            <b-input-group-prepend>
              <b-form-select plain v-model="selectedInputSearch" :options="optionsInputSearch" />
            </b-input-group-prepend>

            <b-form-input v-if="selectedInputSearch == 'title' || selectedInputSearch == 'from' " autofocus v-model="search" @input="onInput" type="text" placeholder="Instant Search">
            </b-form-input>
            <b-form-select v-if="selectedInputSearch !== 'title' && selectedInputSearch !== 'from' " plain v-model="search" :options="optionsSelect[selectedInputSearch]">
              <template slot="first">
                <option disabled :value="''">-- Please Select --</option>
              </template>
            </b-form-select>

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
          <template v-slot:cell(insight)="data">
            <span>{{data.item.visited}} <i class="fa fa-eye"></i></span>
            <span>{{data.item.like}} <i class="fa fa-thumbs-up"></i></span>
            <span>{{data.item.dislike}} <i class="fa fa-thumbs-down"></i></span>
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
            <b-btn variant="success" size="sm" @click="handleDetailMode(data.item.id)">
              <i class="fa fa-search"></i>
            </b-btn>
          </template>
        </b-table>
      </div>
      <div v-show="detailMode">

        <b-container>
          <b-row class=" justify-content-center">
            <b-col md="8" lg="6">
              <div class="d-flex justify-content-between">

                <b-btn variant="secondary" class="mb-3" size="sm" @click="handleBack"><i class="fa fa-arrow-left"></i> Back</b-btn>
                <div>
                  <b-btn v-if="!reportStatus" variant="danger" class="mb-3" size="sm" @click="report"><i class="fa fa-exclamation"></i> Report</b-btn>
                  <b-btn v-if="reportStatus" disabled variant="outline-secondary" class="mb-3" size="sm" @click="report"><i class="fa fa-check"></i> Reported</b-btn>
                </div>
              </div>
              <div v-if="detail.review_status_id == 1">
                <b-alert show>
                  <div>
                    Under review by us, you can respond after it published.
                  </div>
                </b-alert>
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
              <div class="">
                <div cols="12" class="mb-md-0 mb-3">
                  <div class="float-left mr-3 ">
                    <b-img class="rounded rounded-circle" v-if="detail.user.avatar" fluid :src="`/storage/user/${detail.user.avatar}`" style="width: 50px;heigh:auto">
                    </b-img>
                    <b-avatar v-if="!detail.user.avatar" size="50px"><i class="fa fa-user fa-2x"></i> </b-avatar>
                  </div>
                  <div class="mt-2 ">
                    {{detail.user.name}}
                  </div>
                </div>
                <div cols="12" class="pt-3">
                  <p>
                    {{detail.description}}
                  </p>
                </div>
                <div cols="12" class="py-3" v-if="detail.photo">
                  <b-img fluid :src="`/storage/reviewasset/${detail.photo}`"></b-img>
                </div>
              </div>
              <div>
                <div v-if="detail.review_status_id !=1 && !respondData && company.membership_active && (company.respond_quota > 0|| company.respond_unlimited == 1)">
                  <b-form-group :invalid-feedback="error_respond" :state="stateRespond">
                    <b-form-textarea placeholder="Reply Your User Review" v-model="respond" rows="4" :state="stateRespond"></b-form-textarea>
                  </b-form-group>
                  <b-btn variant="primary" size="sm" class="float-right mt-3" @click="sendData">Reply</b-btn>
                </div>
                <div v-if="editMode ">
                  <b-form-group :invalid-feedback="error_respond" :state="stateRespond">
                    <b-form-textarea placeholder="Reply Your User Review" v-model="respond" rows="4" :state="stateRespond"></b-form-textarea>
                  </b-form-group>
                  <div class="float-right">
                    <b-btn variant="secondary" size="sm" class="mr-1" @click="cancelUpdateData">Cancel</b-btn>
                    <b-btn variant="primary" size="sm" @click="updateData">Update</b-btn>
                  </div>

                </div>
                <div class="border-left ml-3 pl-3" v-if="respondData && !editMode">
                  <div class="d-flex mb-3 justify-content-between w-100">
                    <strong class="d-flex">
                      Replied from you
                    </strong>
                    <div class="text-muted">
                      <em>{{detail.company_respond.created_at | dateFormated}}</em>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="float-left mr-3 ">
                      <b-img class="rounded rounded-circle" v-if="detail.company_respond.company.avatar" fluid :src="`/storage/company/${detail.company_respond.company.avatar}`" style="width: 50px;heigh:auto">
                      </b-img>
                      <b-avatar v-if="!detail.company_respond.company.avatar" size="50px"><i class="fa fa-briefcase fa-2x"></i> </b-avatar>
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
                  <div class="text-right">
                    <div>
                      <b-btn size="sm" variant="success" @click="handleEditButton()">Edit</b-btn>
                      <b-btn size="sm" variant="danger" @click="handleDeleteButton()">Delete</b-btn>
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="!company.membership_active && !respondData">
                <b-alert show>
                  <h4>Please Subscribe to Respond</h4>
                  <hr>
                  <div>
                    For responding a review for your company, you need to get quotas and subscribtion any available premium membership.
                  </div>
                </b-alert>
              </div>
              <div v-if="company.membership_active && !respondData && company.respond_quota==0">
                <b-alert show>
                  <h4>Out of Quota</h4>
                  <hr>
                  <div>
                    Your quota for responding a review has been exceded.
                  </div>
                </b-alert>
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
    <confirmation-modal ref="deleteRespondConfirmation" title="Delete Respond" @ok="deleteRespond">
      <template v-slot:body>
        <div>
          You are about to delete your respond for this review and will not getting back the respond quota you spend before
        </div>

      </template>
    </confirmation-modal>
  </div>
</template>
<script>
  import ConfirmationModal from './SlotConfirmationModal.vue'
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
    components: {
      ConfirmationModal
    },
    data: function() {
      return {
        isLoaded: false,
        detailMode: false,
        editMode: false,
        company: {},
        respond: '',
        error_respond: '',
        optionsSelect: {
          answered: [{
              value: 'false',
              text: 'Not Answered'
            },
            {
              value: 'true',
              text: 'Answered'
            }
          ],
          type: [{
              value: 'GENERAL',
              text: 'GENERAL'
            },
            {
              value: 'SOLUTION',
              text: 'SOLUTION'
            },
            {
              value: 'COMPLAIN',
              text: 'COMPLAIN'
            }
          ],
          status: [{
              value: 'IN REVIEW',
              text: 'IN REVIEW'
            },
            {
              value: 'PUBLISHED',
              text: 'PUBLISHED'
            },
            {
              value: 'SUSPENDED',
              text: 'SUSPENDED'
            }
          ]
        },
        review: {
          unanswered: 0,
          answered: 0,
          total: 0,
        },
        detail: {
          index: null,
          title: '',
          rating: null,
          description: '',
          review_status_id: null,
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
      },
      stateRespond() {
        return this.error_respond == 'no-error' ? true : this.error_respond ? false : null
      },
    },
    methods: {
      getFirstChar(name) {

        return this.$options.filters.ucfirst(name);
      },
      handleBack() {
        this.editMode = false
        this.detailMode = false
        this.respond = ''
      },
      getData() {
        let self = this
        axios.get(`/company-dashboard/review`)
          .then((response) => {
            console.log(response.data)
            this.itemsData = response.data.reviews
            this.review = response.data.review
            this.company = response.data.company
            this.isLoaded = true
            self.$emit('updateReviewSummary', response.data.review)
            self.$emit('updateQuota', response.data.company.respond_quota)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      handleEditButton() {
        this.editMode = true
        this.respond = this.detail.company_respond.description
      },
      handleDeleteButton() {
        this.$refs.deleteRespondConfirmation.openModal = true
      },
      deleteRespond() {
        let self = this

        axios.delete(`/company-dashboard/respond-review/${this.detail.company_respond.id}`)
          .then((response) => {
            this.editMode = false
            this.respond = ''
            this.itemsData[this.detail.index].company_respond = null
            this.detail.company_respond = null
            this.review.answered--
            this.review.unanswered++
            this.$emit('updateReviewSummary', self.review)
            this.$refs.deleteRespondConfirmation.openModal = false
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)
          })

      },
      handleDetailMode(id) {
        let i = this.itemsData.findIndex(a => a.id == id)

        this.detail.index = i
        this.detail.id = this.itemsData[i].id
        this.detail.title = this.itemsData[i].title
        this.detail.user = this.itemsData[i].user
        this.detail.created_at = this.itemsData[i].created_at
        this.detail.rating = this.itemsData[i].rating
        this.detail.review_status_id = this.itemsData[i].review_status_id
        this.detail.photo = this.itemsData[i].photo
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
      updateData() {
        let self = this

        axios.patch(`/company-dashboard/respond-review`, {
            respond: this.respond,
            respond_id: this.detail.company_respond.id
          })
          .then((response) => {
            console.log(response.data)
            this.detail.company_respond.description = this.respond
            this.respond = ''
            this.editMode = false
            this.error_respond = ''
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
            this.error_respond = ''
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.error_respond = errors.respond ? errors.respond[0] : 'no-error';
          })
      },
      cancelUpdateData() {
        this.editMode = false
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
            if (!self.company.respond_unlimited) {
              self.company.respond_quota--
              self.$emit('updateQuota', self.company.respond_quota)
            }

            self.review.answered++
            self.review.unanswered--
            self.$emit('updateReviewSummary', self.review)
            this.error_respond = ''

            console.log(self.detail.company_respond);
            this.toastSuccess(response.data.message)

          })
          .catch((error) => {
            console.log(error);
            this.error_respond = ''
            this.toastError(error.response.data.message)
            let errors = error.response.data.errors
            this.error_respond = errors.respond ? errors.respond[0] : 'no-error';
          })
      }
    },
  }
</script>
<style>
</style>
