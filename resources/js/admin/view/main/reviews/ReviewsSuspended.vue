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
      <template v-slot:cell(action)="data">
        <b-btn size="sm" variant="success" @click="edit(data.item,data.index)">Edit</b-btn>
      </template>
    </b-table>
    <reviews-modal ref="reviewsModal" :propsData="selected" @submitted="submit($event)" />
  </div>
</template>
<script>
  import ReviewsModal from './ReviewsModal.vue';
  import {
    FieldTableData
  } from "./ReviewsSuspendedFieldTable"
  export default {
    components: {
      ReviewsModal
    },
    name: 'ReviewsSuspended',
    mixins: [FieldTableData],

    data: function() {
      return {
        selected: {
          index: null,
          name: '',
          company: '',
          title: '',
          description: '',
          rating: null,
          status: ''
        },
        data: [{
            id: 1,
            name: 'John Doe',
            company: 'Good Company',
            title: 'Great Company',
            review_type: 'SOLUTION',
            rating: 5,
            total_useful: 200,
            total_unuseful: 200,
            description: 'This is worst company i ever reviewed, not a good job!',
            reported: 100,
            status: 'SUSPENDED',
            suspended_at: '21-Jun-21',
          },
          {
            id: 1,
            name: 'Jane Doe',
            company: 'Nice Company',
            title: 'Dissaponted Company',
            review_type: 'COMPLAIN',
            rating: 3,
            total_useful: 200,
            total_unuseful: 200,
            description: 'This is worst company i ever reviewed, not a good job!',
            reported: 100,
            status: 'SUSPENDED',
            suspended_at: '21-Jun-21',
          },
        ]
      }
    },
    created() {},
    methods: {
      edit(value, index) {
        console.log(value, index);
        this.selected.status = value.status
        this.selected.name = value.name
        this.selected.company = value.company
        this.selected.title = value.title
        this.selected.description = value.description
        this.selected.rating = value.rating
        this.selected.index = index
        this.$nextTick(() => {
          this.$refs.reviewsModal.modalShow(true)
        });

      },
      submit(e) {
        this.data[e.index].status = e.status
        this.data[e.index].name = e.name
        this.data[e.index].company = e.company
        this.data[e.index].title = e.title
        this.data[e.index].description = e.description
        // this.data[e.index].rating = e.rating
      },
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
