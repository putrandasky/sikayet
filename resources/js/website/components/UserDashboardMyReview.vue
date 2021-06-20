<template>
  <div style="min-height:100px">
    <h3 class="mb-3">My Reviews</h3>
    <b-overlay variant="dark" :show="!isLoaded" blur=""></b-overlay>
    <div v-if="isLoaded && itemsData.length > 0">
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
          <b-pagination align="right" class="justify-content-end mb-0" :total-rows="getTotalRows" v-model="currentPage" />
        </b-col>
      </b-row>
      <div style="overflow-y:auto">
        <b-table small stacked="sm" :fields="FieldTableItems" :items="filteredItemsData" :current-page="currentPage" :per-page="perPage">
          <template v-slot:cell(no)="data">
            {{ data.index + 1 + (currentPage - 1) * perPage }}
            <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
          </template>
          <template v-slot:cell(company_name)="data">
            {{data.item.company_name}}
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
            <b-badge :variant="getBadgeReviewType(data.item.type)" class="p-1">
              {{ data.item.type }}
            </b-badge>
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.status)" class="p-1">
              {{ data.item.status }}
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
              <b-btn variant="danger" size="sm">
                <i class="fa fa-trash"></i>
              </b-btn>
            </div>
          </template>
        </b-table>
      </div>
    </div>
    <b-alert show v-if="isLoaded && itemsData.length == 0">
      <h4>No Review Data</h4>
      <hr>
      <div>
        Review from you will be shown here
      </div>
    </b-alert>
    <b-modal v-if="isLoaded && itemsData.length > 0" v-model="modalEditReview" :hide-footer="input.status !== 'SUSPENDED'" @ok="updateData">
      <template #modal-title>
        <strong>Your review for {{input.company}}</strong>
      </template>
      <b-form-group id="review-title" label="Title" label-for="review-title-input">
        <b-form-input id="review-title-input" v-model="input.title" trim :disabled="input.status !== 'SUSPENDED'"></b-form-input>
      </b-form-group>
      <b-form-group id="review-content" label="Review" label-for="review-content-input">
        <b-form-textarea id="review-content-input" v-model="input.description" rows="3" :disabled="input.status !== 'SUSPENDED'"></b-form-textarea>
      </b-form-group>
      <b-form-group id="rating" label="Rating" label-for="rating-input">
        <b-form-rating id="rating-input" class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating" :disabled="input.status !== 'SUSPENDED'"></b-form-rating>
      </b-form-group>
      <div v-if="input.photo">

        <b-img fluid :src="`/storage/reviewasset/${input.photo}`"></b-img>
      </div>
      <b-form-group id="type" label="Type" label-for="type-input">
        <b-badge :variant="getBadgeReviewType(input.type)" class="p-1">
          {{ input.type }}
        </b-badge>
      </b-form-group>
      <b-form-group id="status" label="Status" label-for="status-input">
        <b-badge :variant="getBadgeStatus(input.status)" class="p-1">
          {{ input.status }}
        </b-badge>
      </b-form-group>

    </b-modal>
  </div>
</template>
<script>
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

    data: function() {
      return {
        isLoaded: false,
        modalEditReview: false,
        input: {
          id: null,
          index: null,
          company: '',
          title: '',
          description: '',
          rating: null,
          status: '',
          photo: ''
        },
        items: [],
        // items: [{
        //     id: 1,
        //     company_name: "GreenHolt LLC",
        //     review_title: 'test',
        //     review_description: 'lorem ipsum dolor sit amet',
        //     rating: 4,
        //     created_at: "20-Jul-21",
        //   },
        //   {
        //     id: 1,
        //     company_name: "GreenHolt LLC",
        //     review_title: 'test',
        //     review_description: 'lorem ipsum dolor sit amet',
        //     rating: 4,
        //     created_at: "20-Jul-21",
        //   },
        //   {
        //     id: 1,
        //     company_name: "GreenHolt LLC",
        //     review_title: 'test',
        //     review_description: 'lorem ipsum dolor sit amet',
        //     rating: 4,
        //     created_at: "20-Jul-21",
        //   },
        //   {
        //     id: 1,
        //     company_name: "GreenHolt LLC",
        //     review_title: 'test',
        //     review_description: 'lorem ipsum dolor sit amet',
        //     rating: 4,
        //     created_at: "20-Jul-21",
        //   },
        // ]
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
        this.input.type = this.itemsData[i].type
        this.input.status = this.itemsData[i].status
        this.input.company = this.itemsData[i].company_name
        this.input.index = i

        this.modalEditReview = true
      },
      updateData(e) {
        e.preventDefault()
        axios.patch(`/user-dashboard/review/${this.input.id}`, this.input)
          .then((response) => {
            this.itemsData[this.input.index].review_title = this.input.title
            this.itemsData[this.input.index].review_description = this.input.description
            this.itemsData[this.input.index].rating = this.input.rating
            this.itemsData[this.input.index].status = 'IN REVIEW'
            console.log(response.data)
            this.toastSuccess(response.data.message)
            this.modalEditReview = false

          })
          .catch((error) => {
            console.log(error);
          })
      },
      getData() {
        axios.get(`user-dashboard/review`)
          .then((response) => {
            this.itemsData = this.mutateKey(response.data)
            console.log(this.input)
            this.isLoaded = true
          })
          .catch((error) => {
            console.log(error);
          })
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          return {
            id: item.id,
            company_name: item.company.name,
            review_title: item.title,
            review_description: item.description,
            rating: item.rating,
            visited: item.visited,
            photo: item.photo,
            like: item.like,
            dislike: item.dislike,
            type: item.review_type.name,
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
