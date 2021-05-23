<template>
  <div>
    <h3>My Packages & Billing</h3>
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
  } from "./CompanyDashboardMyPackageTable"
  export default {
    name: 'CompanyDashboardMyPackage',
    mixins: [MyPackageTable],

    data: function() {
      return {
        items: [{
          subscription_type: 'Standard Package',
          last_payment: '20-Jul-21',
          next_payment: '20-Aug-21',
          payment_method: 'Credit Card',
        }]
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
