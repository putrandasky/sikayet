<template>
  <div style="min-height:100px">
    <h3>{{'dashboard.billing.title'|trans}}</h3>
    <overlay :isLoaded="isLoaded"></overlay>
    <div style="overflow:auto" v-if="isLoaded && items.length > 0">

      <b-table stacked="sm" stack hover :fields="FieldTableItems" :items="items" thead-class="thead-light">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
        </template>
        <template v-slot:cell(date_payment)="data">
          {{data.item.date_payment | dateFormated}}
        </template>
        <template v-slot:cell(status)="data">

          <span v-if="data.item.status == 1">Active</span>
          <span v-if="data.item.status == 0">Unactive</span>
        </template>
        <template v-slot:cell(amount)="data">
          $ {{data.item.amount}}
        </template>
        <template v-slot:cell(respond_quota)="data">
          <span v-if="data.item.respond_quota>0">{{data.item.respond_quota}}</span>
          <span v-if="data.item.respond_quota<0">{{'dashboard.noLimit'|trans}}</span>
        </template>

      </b-table>
    </div>
    <b-alert show v-if="isLoaded && items.length == 0">
      <h4>{{'dashboard.noBillingAlertTitle'|trans}}</h4>
      <hr>
      <div>{{'dashboard.noBillingAlertDescription'|trans}}

      </div>
    </b-alert>

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
        isLoaded: false,
        items: []
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/company-dashboard/index-billing`)
          .then((response) => {
            console.log(response.data)
            this.items = response.data
            this.isLoaded = true
          })
          .catch((error) => {
            console.log(error);
          })
      }
    },
  }
</script>
<style>
</style>
