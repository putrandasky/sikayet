<template>
  <div>
    <h3>My Billing History</h3>
    <div style="overflow:auto">

      <b-table stacked="sm" stack hover :fields="FieldTableItems" :items="items" thead-class="thead-light">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
          <!-- {{data.index+1+((currentPage-1)*perPage)}} -->
        </template>

      </b-table>
    </div>
  </div>
</template>
<script>
  import {
    MyPackageTable
  } from "./CompanyDashboardMyBillingHistoryTable"
  export default {
    name: 'CompanyDashboardMyBillingHistory',
    mixins: [MyPackageTable],

    data: function() {
      return {
        items: [{
            subscription_type: 'Standard Package',
            last_payment: '20-Jul-21',
            payment_invoice: '85452501',
            payment_status: 'Payed',
            payment_method: 'Credit Card',
            amount: '50 USD',
          },
          {
            subscription_type: 'Standard Package',
            last_payment: '20-Aug-21',
            payment_invoice: '85452502',
            payment_status: 'Payed',
            payment_method: 'Credit Card',
            amount: '50 USD',
          },
          {
            subscription_type: 'Standard Package',
            last_payment: '20-Sep-21',
            payment_invoice: '85452503',
            payment_status: 'Payed',
            payment_method: 'Credit Card',
            amount: '50 USD',
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
