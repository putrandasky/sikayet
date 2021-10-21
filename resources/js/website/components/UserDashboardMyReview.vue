<template>
  <div style="min-height:100px">
    <h3 class="mb-3">{{'dashboard.review.title'|trans}}</h3>
    <overlay :isLoaded="isLoaded"></overlay>
    <div v-if="isLoaded && itemsData.length > 0">
      <b-row>
        <b-col xl="4" md="6" class="mb-3">
          <b-input-group>
            <b-input-group-prepend>
              <b-form-select plain v-model="selectedInputSearch" :options="optionsInputSearch" />
            </b-input-group-prepend>
            <b-form-input autofocus v-model="search" @input="onInput" type="text" :placeholder="'common.instantSearch' | trans">
            </b-form-input>
            <b-input-group-append>
              <b-btn :disabled="!search" @click="search = ''">{{'common.clear' | trans}}</b-btn>
            </b-input-group-append>
          </b-input-group>
        </b-col>
        <b-col xl="8" md="6" style="overflow-y:auto" v-if="getTotalPages > 1">
          <b-pagination align="right" class="justify-content-end mb-0" :total-rows="getTotalRows" v-model="currentPage" />
        </b-col>
      </b-row>
      <div style="overflow-y:auto">
        <b-table small stacked="sm" :fields="FieldTableItems" :items="filteredItemsData" :current-page="currentPage" :per-page="perPage">
          <template v-slot:cell(no)="data">
            {{ data.index + 1 + (currentPage - 1) * perPage }}
            <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
          </template>

          <template v-slot:cell(review_title)="data">
            {{data.item.review_title}}
          </template>
          <template v-slot:cell(insight)="data">
            <span>{{data.item.visited}} <i class="fa fa-eye"></i></span>
            <span>{{data.item.like}} <i class="fa fa-thumbs-up"></i></span>
            <span>{{data.item.dislike}} <i class="fa fa-thumbs-down"></i></span>
          </template>
          <template v-slot:cell(type)="data">
            <b-badge :variant="getBadgeReviewType(data.item.review_type.name)" class="p-1">
              {{ data.item.review_type.name }}
            </b-badge>
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.status)" class="p-1">
              {{ data.item.status }}
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
          <template v-slot:cell(rating)="data">
            <div class="w-100">

              <i v-for="v in data.item.rating" :key="v" class="fa fa-star"></i>
            </div>
            {{data.item.rating}} / 5
          </template>
          <template v-slot:cell(created_at)="data">
            {{data.item.created_at | dateFormated}}
          </template>

          <template v-slot:cell(action)="data">

            <div class="d-inline-block">

              <b-btn variant="success" size="sm" @click.prevent.stop="showModalEditReview(data.item.id)">
                <i class="fa fa-pencil"></i>
              </b-btn>
              <b-btn variant="danger" size="sm" @click.prevent.stop="showDeleteConfirmationModal(data.item.id)">
                <i class="fa fa-trash"></i>
              </b-btn>
            </div>
          </template>
        </b-table>
      </div>
    </div>
    <b-alert show v-if="isLoaded && itemsData.length == 0">
      <h4>{{'review.noReviewData' | trans}}</h4>
      <hr>
      <div>
        {{'review.ReviewFromYouShownHere' | trans}}
      </div>
    </b-alert>
    <b-modal v-if="isLoaded && itemsData.length > 0" v-model="modalEditReview" @ok="updateData" :ok-title="'common.ok' | trans" :cancel-title="'common.cancel' | trans">
      <template #modal-title>
        <strong>{{'dashboard.review.reviewFor'|trans}} {{input.company.name}}</strong>
      </template>
      <b-form-group id="review-title" :label="'review.TitleLabel'|trans" label-for="review-title-input">
        <b-form-input id="review-title-input" v-model="input.title" trim></b-form-input>
      </b-form-group>
      <b-form-group id="review-content" :label="'review.DescriptionLabel'|trans" label-for="review-content-input">
        <b-form-textarea id="review-content-input" v-model="input.description" rows="3"></b-form-textarea>
      </b-form-group>

      <div v-if="input.photo" class="mb-3">

        <b-img fluid :src="`/storage/reviewasset/${input.photo}`"></b-img>
      </div>
      <b-row>
        <b-col col>
          <b-form-group id="rating" :label="'review.rating'|trans" label-for="rating-input">
            <b-form-rating id="rating-input" class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
          </b-form-group>
        </b-col>
        <b-col col>
          <b-form-group label="Type">

            <b-form-select plain v-model="input.review_type.id" :options="review_types">
              <template slot="first">
                <option disabled :value="null">-- {{'review.SelectTypePlaceholder'|trans}} --</option>
              </template>
            </b-form-select>
          </b-form-group>
          <!-- <b-form-group id="type" label="Type" label-for="type-input">
            <b-badge :variant="getBadgeReviewType(input.type)" class="p-1">
              {{ input.type }}
            </b-badge>
          </b-form-group> -->
        </b-col>
        <b-col col>
          <b-form-group id="status" :label="'review.status'|trans" label-for="status-input">
            <b-badge :variant="getBadgeStatus(input.status)" class="p-1">
              {{ input.status }}
            </b-badge>
          </b-form-group>
        </b-col>
      </b-row>
      <div v-if="input.company_respond">
        <hr>
        <div class="d-flex mb-3 justify-content-between w-100">
          <strong class="d-flex">
            {{'review.repliedFromBrand'|trans }}
          </strong>
          <div class="text-muted">
            <em>{{input.company_respond.created_at | dateFormated}}</em>
          </div>
        </div>
        <div class="mb-3">
          <div class="float-left mr-3 ">
            <b-img class="rounded rounded-circle" v-if="input.company.avatar" fluid :src="`/storage/company/${input.company.avatar}`" style="width: 50px;heigh:auto">
            </b-img>
            <b-avatar v-if="!input.company.avatar" size="50px"><i class="fa fa-briefcase fa-2x"></i> </b-avatar>
            <!-- <b-img class="rounded rounded-circle img-fluid" src="images/websites/avatar1.jpg" alt="" style="width: 50px;heigh:auto"></b-img> -->
          </div>
          <div class="mt-2 ">
            {{input.company.name}}
          </div>
        </div>
        <div class="pt-3">
          <p>
            {{input.company_respond.description}}
          </p>
        </div>
      </div>



    </b-modal>
    <confirmation-modal ref="deleteReviewConfirmation" :title="'review.deleteReview'|trans" @ok="deleteData">
      <template v-slot:body>
        <div>
          {{'review.user.deleteConfirmationDescription'|trans}}
        </div>

      </template>
    </confirmation-modal>
  </div>
</template>
<script>
  // import Overlay from '../widgets/Overlay.vue'
  import ConfirmationModal from './SlotConfirmationModal.vue'
  import {
    Badge
  } from "../mixins/MixinBadge";
  import {
    instantSearch
  } from "../mixins/instantSearch";
  import {
    OperationPage
  } from "../mixins/OperationPage";
  import {
    MyReviewTable
  } from "./UserDashboardMyReviewTable"
  export default {
    name: 'UserDashboardMyReview',
    mixins: [Badge, MyReviewTable, instantSearch, OperationPage],
    components: {
      ConfirmationModal
    },
    data: function() {
      return {
        isLoaded: false,
        modalEditReview: false,
        review_types: [],
        input: {
          id: null,
          index: null,
          company: '',
          title: '',
          description: '',
          rating: null,
          status: '',
          photo: '',
          review_type: {
            id: null
          }
        },
        items: [],
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      showModalEditReview(id) {
        let i = this.itemsData.findIndex(a => a.id == id)
        this.input.title = this.itemsData[i].review_title
        this.input.id = this.itemsData[i].id
        this.input.description = this.itemsData[i].review_description
        this.input.rating = this.itemsData[i].rating
        this.input.photo = this.itemsData[i].photo
        this.input.review_type = this.itemsData[i].review_type
        this.input.status = this.itemsData[i].status
        this.input.company = this.itemsData[i].company
        this.input.company_respond = this.itemsData[i].company_respond
        this.input.index = i

        this.modalEditReview = true
      },
      updateData(e) {
        e.preventDefault()
        let newData = this.review_types.find(
          data => data.value == this.input.review_type.id
        )
        let new_review_type = {
          id: newData.value,
          name: newData.text,
        }
        console.log(this.input.review_type.id);
        axios.patch(`/user-dashboard/review/${this.input.id}`, this.input)
          .then((response) => {
            this.itemsData[this.input.index].review_title = this.input.title
            this.itemsData[this.input.index].review_description = this.input.description
            this.itemsData[this.input.index].rating = this.input.rating
            this.itemsData[this.input.index].review_type = new_review_type
            this.itemsData[this.input.index].status = 'IN REVIEW'
            console.log(response.data)
            this.toastSuccess(response.data.message)
            this.modalEditReview = false

          })
          .catch((error) => {
            console.log(error);
          })
      },
      showDeleteConfirmationModal(id) {
        let i = this.itemsData.findIndex(a => a.id == id)
        this.input.id = this.itemsData[i].id
        this.input.index = i

        this.$refs.deleteReviewConfirmation.openModal = true
      },
      deleteData() {
        axios.delete(`/user-dashboard/review/${this.input.id}`)
          .then((response) => {
            this.itemsData.splice(this.input.index, 1)
            console.log(response.data)
            this.toastSuccess(response.data.message)
            this.modalEditReview = false
            this.$refs.deleteReviewConfirmation.openModal = false

          })
          .catch((error) => {
            console.log(error);
          })
      },
      getData() {
        axios.get(`user-dashboard/review`)
          .then((response) => {
            this.itemsData = this.mutateKeyItemsData(response.data.reviews)
            this.review_types = this.mutateKey(response.data.review_types)
            console.log(this.itemsData)
            this.isLoaded = true
          })
          .catch((error) => {
            console.log(error);
          })
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          return {
            value: item.id,
            text: item.range || item.name || item.description,
            state: false
          };
        });
        return mutateData;
      },
      mutateKeyItemsData(data) {
        let mutateData = data.map(function(item) {
          return {
            id: item.id,
            company: item.company,
            review_title: item.title,
            review_description: item.description,
            rating: item.rating,
            company_respond: item.company_respond,
            visited: item.visited,
            photo: item.photo,
            like: item.like,
            dislike: item.dislike,
            review_type: item.review_type,
            status: item.review_status.name,
            created_at: item.created_at,
          };
        });
        return mutateData;
      },
    },
  }
</script>
<style>
</style>
