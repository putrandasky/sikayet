<template>

  <b-card>
    <b-card-title>
      <strong>Company Plans</strong>
    </b-card-title>
    <b-card-text>

      Show that you care about your customers. Subscribe as a premium company and claim your page to take advantage of the membership.
    </b-card-text>
    <b-row class="mb-3">
      <b-col md="4">
        <pricing icon="paper-plane">
          <template v-slot:title>
            Standard
          </template>
          <template v-slot:subtitle>
            This is standard package
          </template>
          <template v-slot:benefits>
            <ol class="pl-3">
              <li>Manage One Company</li>
              <li>Email Notifications when someone posts a new review to your company</li>
              <li>No ADS on your company page</li>
              <li>Reply to reviews in the name of your company</li>
              <li>Answer limit : 20</li>
            </ol>
          </template>
          <template v-slot:buyMonthly>
            <div class="mb-2">
              50 usd / Month
            </div>
            <b-btn size="sm" variant="dark">Buy Monthly</b-btn>
          </template>
          <template v-slot:buyAnnualy>
            <div class="mb-2">
              400 usd / 12 Month
            </div>
            <b-btn size="sm" variant="primary">Buy Annualy</b-btn>
          </template>

        </pricing>
      </b-col>
      <b-col md="4">
        <pricing icon="plane">
          <template v-slot:title>
            Extended
          </template>
          <template v-slot:subtitle>
            This is extended package
          </template>
          <template v-slot:benefits>
            <ol class="pl-3">
              <li>Manage One Company</li>
              <li>Email Notifications when someone posts a new review to your company</li>
              <li>No ADS on your company page</li>
              <li>Reply to reviews in the name of your company</li>
              <li>Answer limit : 100</li>
            </ol>
          </template>
          <template v-slot:buyMonthly>
            <div class="mb-2">
              150 usd / Month
            </div>
            <b-btn size="sm" variant="dark">Buy Monthly</b-btn>
          </template>
          <template v-slot:buyAnnualy>
            <div class="mb-2">
              1500 usd / 12 Month
            </div>
            <b-btn size="sm" variant="primary">Buy Annualy</b-btn>
          </template>

        </pricing>
      </b-col>
      <b-col md="4">
        <pricing icon="rocket">
          <template v-slot:title>
            Premium
          </template>
          <template v-slot:subtitle>
            This is premium package
          </template>
          <template v-slot:benefits>
            <ol class="pl-3">
              <li>Manage One Company</li>
              <li>Email Notifications when someone posts a new review to your company</li>
              <li>No ADS on your company page</li>
              <li>Reply to reviews in the name of your company</li>
              <li>Answer limit : No Limit</li>
            </ol>
          </template>
          <template v-slot:buyMonthly>
            <div class="mb-2">
              500 usd / Month
            </div>
            <b-btn size="sm" variant="dark">Buy Monthly</b-btn>
          </template>
          <template v-slot:buyAnnualy>
            <div class="mb-2">
              4000 usd / 12 Month
            </div>
            <b-btn size="sm" variant="primary">Buy Annualy</b-btn>
          </template>

        </pricing>
      </b-col>
    </b-row>
    <b-row>
      <b-col cols="12">
        <div class="accordion" role="tablist">
          <b-card v-for="v,i in information" :key="i" no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
              <b-button block v-b-toggle="`information-${i}`" variant="light">{{v.title}}</b-button>
            </b-card-header>
            <b-collapse :id="`information-${i}`" visible accordion="my-accordion" role="tabpanel">
              <b-card-body>

                <b-card-text>{{ v.content }}</b-card-text>
              </b-card-body>
            </b-collapse>
          </b-card>
        </div>
      </b-col>
    </b-row>
  </b-card>
</template>
<script>
  import Pricing from './CompanyDashboardPlansPricingTable'
  export default {
    name: 'CompanyDashboardPlans',
    components: {
      Pricing
    },
    data: function() {
      return {
        information: [{
            title: 'Introduction',
            content: 'Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
          },
          {
            title: 'Generative Modeling Review',
            content: 'Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
          },
          {
            title: 'Variational Autoencoders',
            content: 'Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably havent heard of them accusamus labore sustainable VHS Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
          },
        ]
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
