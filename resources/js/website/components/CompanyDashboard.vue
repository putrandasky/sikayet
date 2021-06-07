<template>
  <b-container>
    <b-row class="mb-3">
      <b-col sm="4">
        <b-card class="text-center">
          <h1>{{review_unanswered}}</h1>
          <div>
            New Review
          </div>
        </b-card>
      </b-col>
      <b-col sm="4">
        <b-card class="text-center">
          <h1>{{review_answered}}</h1>
          <div>
            Answered Review
          </div>
        </b-card>
      </b-col>
      <b-col sm="4">
        <b-card class="text-center">
          <h1>{{review_total}}</h1>
          <div>
            Total Answered
          </div>
        </b-card>
      </b-col>

    </b-row>
    <b-card class="mb-3">

      <b-nav tabs class="mb-3">
        <b-nav-item :active="component == 'MyReview'" @click="component = 'MyReview'">My Review</b-nav-item>
        <b-nav-item :active="component == 'MyAccount'" @click="component = 'MyAccount'">My Account</b-nav-item>
        <b-nav-item :active="component == 'MyPackage'" @click="component = 'MyPackage'">My Package & Billing</b-nav-item>
        <b-nav-item :active="component == 'MyBillingHistory'" @click="component = 'MyBillingHistory'">Billing History</b-nav-item>
        <b-nav-item :active="component == 'Password'" @click="component = 'Password'">Password</b-nav-item>
        <b-nav-item>
          <b-btn variant="danger" size="sm" @click="logout">Log Out</b-btn>
        </b-nav-item>
      </b-nav>
      <component v-bind:is="component"></component>
    </b-card>
    <plans />
  </b-container>
</template>
<script>
  import {
    EventBus
  } from "../event.js";
  import MyReview from './CompanyDashboardMyReview'
  import MyAccount from './CompanyDashboardMyAccount'
  import MyPackage from './CompanyDashboardMyPackage'
  import Password from './CompanyDashboardPassword'
  import MyBillingHistory from './CompanyDashboardMyBillingHistory'
  import Plans from './CompanyDashboardPlans'
  export default {
    name: 'CompanyDashboard',
    props: ['review_total', 'review_answered', 'review_unanswered'],
    components: {
      MyAccount,
      Plans,
      MyPackage,
      MyBillingHistory,
      Password,
      MyReview

    },
    data: function() {
      return {
        component: 'MyReview',
        review: {
          unanswered: 0,
          answered: 0,
          total: 0,
        }
      }
    },
    created() {
      EventBus.$on('initReviewsSummary', data => {
        console.log(data);
        this.review.answered = data.answered
        this.review.unanswered = data.unanswered
        this.review.total = data.total
      })
    },
    methods: {
      initReviewsSummary(data) {
        console.log(data);

      },
      logout() {
        window.open('/company-logout', '_self')
      }
    },
  }
</script>
<style>
</style>
