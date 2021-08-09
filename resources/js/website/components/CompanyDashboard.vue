<template>
  <b-container>

    <b-row class="mb-3" v-show="!isPaymentProcess">
      <b-col sm="3">
        <b-card v-show="isLoaded" class="text-center">
          <h1>{{review.unanswered}}</h1>
          <div>
            {{'dashboard.summary.new'|trans}}
          </div>
        </b-card>
      </b-col>
      <b-col sm="3">
        <b-card v-show="isLoaded" class="text-center">
          <h1>{{review.answered}}</h1>
          <div>
            {{'dashboard.summary.answered'|trans}}
          </div>
        </b-card>
      </b-col>
      <b-col sm="3">
        <b-card v-show="isLoaded" class="text-center">
          <h1>{{review.total}}</h1>
          <div>
            {{'dashboard.summary.total'|trans}}
          </div>
        </b-card>
      </b-col>
      <b-col sm="3">
        <b-card v-show="isLoaded" class="text-center">
          <h1>{{respond_quota}}</h1>
          <div>
            {{'dashboard.summary.quotas'|trans}}
          </div>
        </b-card>
      </b-col>

    </b-row>
    <b-card class="mb-3" v-show="!isPaymentProcess">

      <b-nav tabs class="mb-3" style="overflow-x: auto;overflow-y: hidden;
    white-space: nowrap;
    flex-wrap: unset;">
        <b-nav-item :active="component == 'MyReview'" @click="component = 'MyReview'">{{'dashboard.review.title'|trans}}</b-nav-item>
        <b-nav-item :active="component == 'MyAccount'" @click="component = 'MyAccount'">{{'dashboard.account.title'|trans}}</b-nav-item>
        <b-nav-item :active="component == 'MyPackage'" @click="component = 'MyPackage'"> {{'dashboard.package.title'|trans}}</b-nav-item>
        <b-nav-item :active="component == 'MyBillingHistory'" @click="component = 'MyBillingHistory'">{{'dashboard.billing.title'|trans}}</b-nav-item>
        <b-nav-item :active="component == 'Password'" @click="component = 'Password'">{{'auth.password'|trans}}</b-nav-item>
        <b-nav-item>
          <b-btn variant="danger" size="sm" @click="logout">{{'auth.logout'|trans}}</b-btn>
        </b-nav-item>
      </b-nav>
      <component :companydata="company" :business_category="business_category" @updateReviewSummary="updateReviewSummary" @updateQuota="updateQuota" v-bind:is="component"></component>
    </b-card>
    <plans v-if="!company.respond_unlimited" @updateQuota="updateQuota" @setpaymentprocess="setpaymentprocess($event)" />
    <membership-info></membership-info>
  </b-container>
</template>
<script>
  import {
    EventBus
  } from "../event.js";
  import SummaryData from './CompanyDashboardSummary'
  import MembershipInfo from './CompanyDashboardMembershipInfo'
  import MyReview from './CompanyDashboardMyReview'
  import MyAccount from './CompanyDashboardMyAccount'
  import MyPackage from './CompanyDashboardMyPackage'
  import Password from './CompanyDashboardPassword'
  import MyBillingHistory from './CompanyDashboardMyBillingHistory'
  import Plans from './CompanyDashboardPlans'
  export default {
    name: 'CompanyDashboard',
    props: ['company', 'business_category'],
    components: {
      MyAccount,
      Plans,
      MyPackage,
      MyBillingHistory,
      Password,
      MyReview,
      SummaryData,
      MembershipInfo

    },
    data: function() {
      return {

        component: 'MyReview',
        isPaymentProcess: false,
        isLoaded: false,
        respond_quota: 0,
        review: {
          unanswered: 0,
          answered: 0,
          total: 0,
        }
      }
    },
    mounted() {
      // let self = this
      // EventBus.$on('initReviewsSummary', function(data) {
      //   console.log(data);
      //   console.log('emit');
      //   self.review.answered = data.answered
      //   self.review.unanswered = data.unanswered
      //   self.review.total = data.total
      // }.bind(self))
      console.log(this.company);
    },
    methods: {
      setpaymentprocess(e) {
        this.isPaymentProcess = e
      },
      updateQuota(data) {
        this.respond_quota = data

      },
      updateReviewSummary(data) {
        this.review.answered = data.answered
        this.review.unanswered = data.unanswered
        this.review.total = data.total
        this.isLoaded = true
      },
      logout() {
        window.open('/company-logout', '_self')
      }
    },
  }
</script>
<style>
</style>
