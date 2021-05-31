<template>
  <b-container class="py-3">
    <b-card>
      <b-card-title>
        User List
      </b-card-title>
      <div style="overflow-y:auto">
        <b-table small stacked="sm" :fields="FieldTableItems" :items="data">
          <template v-slot:cell(no)="data">
            {{data.index+1}}
          </template>
          <template v-slot:cell(status)="data">
            <b-badge :variant="getBadgeStatus(data.item.status.text)" class="p-1">
              {{ data.item.status.text }}
            </b-badge>
          </template>
          <template v-slot:cell(action)="data">
            <b-btn size="sm" variant="success" @click="showUserModal(data.item,data.index)">Edit</b-btn>
          </template>
        </b-table>
      </div>
    </b-card>
    <b-modal v-model="isUsersModalShow" title="User Data" @ok="submit">
      <b-form-group label="Name">
        <b-form-input disabled v-model="selected.name"></b-form-input>
      </b-form-group>
      <b-form-group label="Email">
        <b-form-input disabled v-model="selected.email"></b-form-input>
      </b-form-group>
      <b-form-group label="Status">

        <b-form-select plain v-model="selected.user_status_id" :options="options.user_status">
          <template slot="first">
            <option :value="null" disabled>-- Please Select User Status --</option>
          </template>
        </b-form-select>
      </b-form-group>
    </b-modal>
  </b-container>
</template>
<script>
  import {
    FieldTableData
  } from "./UserFieldTable"
  export default {
    name: 'Users',
    mixins: [FieldTableData],

    data: function() {
      return {
        isUsersModalShow: false,
        selectedIndex: null,
        selected: {
          name: '',
          email: '',
          user_status_id: null
        },
        options: {
          user_status: [{
              value: 1,
              text: 'ACTIVE'
            },
            {
              value: 2,
              text: 'SUSPEND'
            }
          ]
        },
        data: [{
            id: 1,
            name: 'John Doe',
            email: 'john@mail.com',
            total_review: 2000,
            total_useful: 200,
            total_unuseful: 200,
            created_at: '21-Jun-21',
            status: {
              value: 1,
              text: 'ACTIVE'
            }
          },
          {
            id: 1,
            name: 'Jane Doe',
            email: 'jane@mail.com',
            total_review: 1000,
            total_useful: 22,
            total_unuseful: 22,
            created_at: '21-Jun-21',
            status: {
              value: 2,
              text: 'SUSPEND'
            },
          },
        ]
      }
    },
    created() {},
    methods: {
      showUserModal(value, index) {
        this.isUsersModalShow = true
        this.selected.user_status_id = value.status.value
        this.selected.name = value.name
        this.selected.email = value.email
        this.selectedIndex = index

      },
      submit() {
        let newData = this.options.user_status.find(
          data => data.value == this.selected.user_status_id
        )
        this.data[this.selectedIndex].status = newData
      },
      getBadgeStatus(status) {
        return status === "ACTIVE" ?
          "success" :
          status === "SUSPEND" ?
          "danger" :
          "secondary";
      },
    },
  }
</script>
<style>
</style>
