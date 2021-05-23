<template>
  <div>
    <h3>My Reviews</h3>
    <div style="overflow:auto">

      <b-table stacked="sm" stack hover :fields="FieldTableItems" :items="items" thead-class="thead-light">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
          <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
        </template>
        <template v-slot:cell(company_name)="data">
          {{data.item.company_name}}
        </template>
        <template v-slot:cell(review_title)="data">
          {{data.item.review_title}}
        </template>
        <template v-slot:cell(rating)="data">
          <div class="w-100">

            <i v-for="v in data.item.rating" :key="v" class="fa fa-star"></i>
          </div>
          {{data.item.rating}} / 5
        </template>
        <template v-slot:cell(created_at)="data">
          {{data.item.created_at}}
        </template>
        <template v-slot:cell(action)="data">
          <div class="d-inline-block">

            <b-btn variant="success" size="sm" @click="showModalEditReview(data.index)">
              <i class="fa fa-pencil"></i>
            </b-btn>
            <b-btn variant="danger" size="sm">
              <i class="fa fa-trash"></i>
            </b-btn>
          </div>
        </template>
      </b-table>
    </div>
    <b-modal v-model="modalEditReview" title="Edit Review">
      <b-form-group id="review-title" label="Title" label-for="review-title-input">
        <b-form-input id="review-title-input" v-model="input.title" trim></b-form-input>
      </b-form-group>
      <b-form-group id="review-content" label="Review" label-for="review-content-input">
        <b-form-textarea id="review-content-input" v-model="input.content" rows="3"></b-form-textarea>
      </b-form-group>
      <b-form-group id="rating" label="Rating" label-for="rating-input">
        <b-form-rating id="rating-input" class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
      </b-form-group>
    </b-modal>
  </div>
</template>
<script>
  import {
    MyReviewTable
  } from "./UserDashboardMyReviewTable"
  export default {
    name: 'UserDashboardMyReview',
    mixins: [MyReviewTable],

    data: function() {
      return {
        modalEditReview: false,
        input: {
          title: '',
          content: '',
          rating: null
        },
        items: [{
            id: 1,
            company_name: "GreenHolt LLC",
            review_title: 'test',
            review_content: 'lorem ipsum dolor sit amet',
            rating: 4,
            created_at: "20-Jul-21",
          },
          {
            id: 1,
            company_name: "GreenHolt LLC",
            review_title: 'test',
            review_content: 'lorem ipsum dolor sit amet',
            rating: 4,
            created_at: "20-Jul-21",
          },
          {
            id: 1,
            company_name: "GreenHolt LLC",
            review_title: 'test',
            review_content: 'lorem ipsum dolor sit amet',
            rating: 4,
            created_at: "20-Jul-21",
          },
          {
            id: 1,
            company_name: "GreenHolt LLC",
            review_title: 'test',
            review_content: 'lorem ipsum dolor sit amet',
            rating: 4,
            created_at: "20-Jul-21",
          },
        ]
      }
    },
    created() {},
    methods: {
      showModalEditReview(i) {

        this.input.title = this.items[i].review_title
        this.input.content = this.items[i].review_content
        this.input.rating = this.items[i].rating
        this.modalEditReview = true
      }
    },
  }
</script>
<style>
</style>
