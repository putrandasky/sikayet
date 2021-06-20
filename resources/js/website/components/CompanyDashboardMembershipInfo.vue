<template>
  <b-card>

    <b-row>
      <b-col cols="12">
        <div class="accordion" role="tablist">
          <b-card v-for="v,i in information" :key="i" no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
              <b-button block v-b-toggle="`information-${i}`" variant="light">{{v.title}}</b-button>
            </b-card-header>
            <b-collapse :id="`information-${i}`" visible accordion="my-accordion" role="tabpanel">
              <b-card-body>

                <b-card-text v-html="v.description"> </b-card-text>
              </b-card-body>
            </b-collapse>
          </b-card>
        </div>
      </b-col>
    </b-row>
  </b-card>
</template>
<script>
  export default {
    name: 'CompanyDashboardMembershipInfo',
    data: function() {
      return {
        information: []
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/company-dashboard/membership-info`)
          .then((response) => {
            console.log(response.data)
            this.information = response.data
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
