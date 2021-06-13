<template>
  <b-row class="mb-3">
    <b-col sm="4">
      <b-card class="text-center">
        <h1>{{review.unanswered}}</h1>
        <div>
          New Review
        </div>
      </b-card>
    </b-col>
    <b-col sm="4">
      <b-card class="text-center">
        <h1>{{review.answered}}</h1>
        <div>
          Answered Review
        </div>
      </b-card>
    </b-col>
    <b-col sm="4">
      <b-card class="text-center">
        <h1>{{review.total}}</h1>
        <div>
          Total Answered
        </div>
      </b-card>
    </b-col>

  </b-row>
</template>
<script>
  // import {
  //   EventBus
  // } from "../event.js";
  export default {
    name: 'CompanyDashboardSummary',
    data: function() {
      return {
        review: {
          unanswered: 0,
          answered: 0,
          total: 0,
        }
      }
    },
    created() {
      EventBus.$on('reviewsummary', function(data) {
        console.log(data);
        console.log('emit');
        this.review.answered = data.answered
        this.review.unanswered = data.unanswered
        this.review.total = data.total
      })
    },
    methods: {

    },
  }
</script>
<style>
</style>
