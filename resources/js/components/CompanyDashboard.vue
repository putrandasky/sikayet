<template>
  <b-container>
    <b-row class="mb-3">
      <b-col sm="4">
        <b-card class="text-center">
          <h1>16</h1>
          <div>
            New Review
          </div>
        </b-card>
      </b-col>
      <b-col sm="4">
        <b-card class="text-center">
          <h1>16</h1>
          <div>
            Answered Review
          </div>
        </b-card>
      </b-col>
      <b-col sm="4">
        <b-card class="text-center">
          <h1>16</h1>
          <div>
            Total Review
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
          <b-btn variant="danger" size="sm">Log Out</b-btn>
        </b-nav-item>
      </b-nav>
      <component v-bind:is="component"></component>
    </b-card>
    <plans />
  </b-container>
</template>
<script>
  import MyReview from './CompanyDashboardMyReview'
  import MyAccount from './CompanyDashboardMyAccount'
  import MyPackage from './CompanyDashboardMyPackage'
  import Password from './CompanyDashboardPassword'
  import MyBillingHistory from './CompanyDashboardMyBillingHistory'
  import Plans from './CompanyDashboardPlans'
  export default {
    name: 'CompanyDashboard',
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
        component: 'MyReview'
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
