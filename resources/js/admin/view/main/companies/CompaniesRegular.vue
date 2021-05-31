<template>
  <div style="overflow-y:auto">
    <b-table small stacked="sm" :fields="FieldTableItems" :items="data">
      <template v-slot:cell(no)="data">
        {{data.index+1}}
      </template>
      <template v-slot:cell(verified)="data">
        <b-badge v-if="data.item.verified" variant="success">
          <i class="fa fa-check"></i>
        </b-badge>
        <b-badge v-if="!data.item.verified" variant="danger">
          <i class="fa fa-close"></i>
        </b-badge>
      </template>

      <template v-slot:cell(action)="data">
        <b-btn size="sm" variant="success" @click="edit(data.item,data.index)">Edit</b-btn>
      </template>
    </b-table>
    <companies-modal ref="companiesModal" :propsData="selected" @submitted="submit($event)" />
  </div>
</template>
<script>
  import CompaniesModal from './CompaniesModal.vue'
  import {
    FieldTableData
  } from "./CompaniesRegularFieldTable"
  export default {
    components: {
      CompaniesModal
    },
    name: 'CompaniesRegular',
    mixins: [FieldTableData],

    data: function() {
      return {
        selected: {
          index: null,
          name: '',
          email: '',
          verified: null,
          status: ''
        },
        data: [{
            id: 1,
            name: 'Good Company',
            email: 'my_company@mail.com',
            verified: true,
            total_reviewed: 2000,
            total_complain: 22,
            status: 'ACTIVE',
            created_at: '21-Jun-21',
          },
          {
            id: 1,
            name: 'Great Company',
            email: 'great_company@mail.com',
            verified: true,
            total_reviewed: 1000,
            total_complain: 22,
            status: 'ACTIVE',
            created_at: '21-Jun-21',
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
        this.selected.email = value.email
        this.selected.verified = value.verified
        this.selected.index = index
        this.$nextTick(() => {
          this.$refs.companiesModal.modalShow(true)
        });

      },
      submit(e) {
        this.data[e.index].status = e.status
        this.data[e.index].verified = e.verified
      }
    },
  }
</script>
<style>
</style>
