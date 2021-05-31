<template>
  <div style="overflow-y:auto">
    <b-table small stacked="sm" :fields="FieldTableItems" :items="data">
      <template v-slot:cell(no)="data">
        {{data.index+1}}
      </template>
      <template v-slot:cell(review_type)="data">
        <b-badge :variant="getBadgeReviewType(data.item.review_type)" class="p-1">
          {{ data.item.review_type }}
        </b-badge>
      </template>
      <template v-slot:cell(rating)="data">
        <i class="fa fa-star"></i> {{data.item.rating}}
      </template>
      <template v-slot:cell(action)>
        <b-btn size="sm" variant="success">Edit</b-btn>
      </template>
    </b-table>
  </div>
</template>
<script>
  // import {
  //   FieldTableData
  // } from "./ReviewsReportedFieldTable"
  export default {
    name: 'ReviewsActive',
    // mixins: [FieldTableData],

    data: function() {
      return {
        data: [{
            id: 1,
            name: 'John Doe',
            company: 'Good Company',
            title: 'Great Company',
            review_type: 'SOLUTION',
            rating: 5,
            created_at: '21-Jun-21',
          },
          {
            id: 1,
            name: 'Jane Doe',
            company: 'Nice Company',
            title: 'Dissaponted Company',
            review_type: 'COMPLAIN',
            rating: 3,
            created_at: '21-Jun-21',
          },
        ]
      }
    },
    created() {},
    methods: {
      getBadgeReviewType(status) {
        return status === "SOLUTION" ?
          "success" :
          status === "COMPLAIN" ?
          "danger" :
          "secondary";
      },
    },
  }
</script>
<style>
</style>
