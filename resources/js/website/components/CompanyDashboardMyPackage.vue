<template>
  <div style="min-height:100px">
    <h3>{{'dashboard.package.title'|trans}}</h3>
    <overlay :isLoaded="isLoaded"></overlay>

    <div style="overflow:auto" v-if="isLoaded  && items[0]">

      <b-table stacked="sm" stack hover :fields="FieldTableItems" :items="items" thead-class="thead-light">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
        </template>
        <template v-slot:cell(date_payment)="data">
          {{data.item.date_payment | dateFormated}}
        </template>
        <template v-slot:cell(ending_period)="data">
          {{data.item.ending_period | dateFormated}}
        </template>

      </b-table>
    </div>
    <b-alert show v-if="isLoaded && !items[0]">
      <h4>{{'dashboard.package.noPackageAlert.title'|trans}}</h4>
      <hr>
      <div>
        {{'dashboard.package.noPackageAlert.description'|trans}}
      </div>
    </b-alert>
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
        isLoaded: false,
        items: []
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/company-dashboard/current-membership`)
          .then((response) => {
            console.log(response.data)
            this.items.push(response.data)
            this.isLoaded = true
            console.log(this.items);
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
