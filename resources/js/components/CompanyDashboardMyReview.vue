<template>
  <div>
    <h3 class="mb-3">Company Reviews</h3>
    <div v-show="!detailMode" style="overflow:auto">

      <b-table stacked="sm" stack hover :fields="FieldTableItems" :items="items" thead-class="thead-light">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
          <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
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
          <b-btn variant="success" size="sm" @click="editMode(data.index)">
            See Review
          </b-btn>
        </template>
      </b-table>
    </div>
    <div v-show="detailMode">

      <b-container>
        <b-row class=" justify-content-center">
          <b-col md="8" lg="6">
            <b-btn variant="secondary" class="mb-3" size="sm" @click="detailMode = false"><i class="fa fa-arrow-left"></i> Back</b-btn>

            <div class=" d-block d-sm-flex justify-content-between">
              <div>
                <h4>
                  <strong>
                    {{detail.title}}
                  </strong>
                </h4>
              </div>
              <div class="text-muted">
                <em>{{detail.created_at}}</em>
              </div>
            </div>
            <div class="d-flex mb-3">
              <div v-for="i in detail.rating" :key="'green'+i" class="bg-success rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
              <div v-for="i in (5 - detail.rating)" :key="i" class="bg-secondary rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
            </div>
            <b-row v-for="v,i in detail.reviews" :key="'grey'+i" class="">
              <b-col md="2" class="mb-md-0 mb-3">
                <div class="float-md-none float-left mr-3 mr-md-0 ">
                  <b-img class="rounded rounded-circle img-fluid" src="images/websites/avatar1.jpg" alt="" style="width: 50px;heigh:auto"></b-img>
                </div>
                <div class="mt-2 mt-md-0">
                  {{v.user}}
                </div>
              </b-col>
              <b-col md="10">
                <p>
                  {{v.content}}
                </p>
              </b-col>
            </b-row>
            <div>
              <b-form-textarea placeholder="Reply Your User Review" v-model="input" rows="4"></b-form-textarea>
              <b-btn variant="primary" size="sm" class="float-right mt-3">Reply</b-btn>
            </div>
          </b-col>

        </b-row>
      </b-container>
    </div>
  </div>
</template>
<script>
  import {
    MyReviewTable
  } from "./CompanyDashboardMyReviewTable"
  export default {
    name: 'UserDashboardMyReview',
    mixins: [MyReviewTable],

    data: function() {
      return {
        detailMode: false,
        input: '',
        detail: {
          title: '',
          rating: null,
          created_at: "",
          reviews: [{
            id: null,
            user: '',
            content: '',
            account_role: ''
          }, ]
        },
        items: [{
          id: 1,
          company_name: "GreenHolt LLC",
          review_title: '"Avesome Experience"',
          rating: 4,
          status: 'No Answer',
          created_at: "20-Jul-21",
          reviews: [{
            id: 1,
            user: 'Lukas',
            content: 'Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et',
            account_role: 'user'
          }, ]
        }, ]
      }
    },
    created() {},
    methods: {
      editMode(i) {

        this.detail.title = this.items[i].review_title
        this.detail.content = this.items[i].review_content
        this.detail.created_at = this.items[i].created_at
        this.detail.rating = this.items[i].rating
        this.detail.reviews = this.items[i].reviews
        this.detailMode = true
      }
    },
  }
</script>
<style>
</style>
