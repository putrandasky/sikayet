<template>
  <b-container class="py-3">
    <b-card>
      <b-card-title>
        Customizing Company Plans
      </b-card-title>
      <b-alert variant="info" show>
        <p>
          All business company plans include feature
        </p>
        <ul>
          <li>Email Notifications when someone posts a new review to company</li>
          <li>No ADS on company page</li>
        </ul>
      </b-alert>
      <div v-show="mode == 'view'" style="overflow-y: auto">
        <div class="text-right mb-3">
          <b-btn size="sm" variant="primary" @click="addNew">Add Plans</b-btn>
        </div>
        <b-table-lite stacked="sm" :fields="FieldTableItems" :items="items">
          <template v-slot:cell(no)="data">
            {{data.index+1}}
          </template>
          <template v-slot:cell(monthly_price)="data">
            $ {{data.item.monthly_price}}
          </template>
          <template v-slot:cell(annual_price)="data">
            $ {{data.item.annual_price}}
          </template>
          <template v-slot:cell(action)="data">
            <div class="d-flex">
              <b-btn size="sm" variant="success" @click="edit(data.item,data.index)"><i class="fa fa-edit"></i></b-btn>
              <b-btn size="sm" variant="danger" @click="handleDelete(data.item.id ,data.index)"><i class="fa fa-trash"></i></b-btn>
            </div>

          </template>
        </b-table-lite>
      </div>
      <div v-show="mode != 'view'">
        <div class="mb-3">
          <b-btn size="sm" variant="secondary" @click="back">Back</b-btn>
        </div>
        <b-row>
          <b-col md="3">
            <b-form-group label="Plan Icon">
              <b-form-input v-model="input.icon" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="3">
            <b-form-group label="Plan Name">
              <b-form-input v-model="input.subscription_type" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="Plan Subtitle">
              <b-form-input v-model="input.subscription_subtitle" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4">
            <b-form-group label="Answer Quota ">
              <b-input-group append="Answer / Month">
                <b-form-input v-model="input.respond_quota" type="number"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col md="4">
            <b-form-group label="Monthly Price">
              <b-input-group prepend="$" append=".00">
                <b-form-input v-model="input.monthly_price" type="number"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col md="4">
            <b-form-group label="Annual Price (12 Months)">
              <b-input-group prepend="$" append=".00">
                <b-form-input v-model="input.annual_price" type="number"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
        <div class="text-right mb-3">
          <b-btn size="sm" variant="primary" @click="handleSubmit">Submit</b-btn>
        </div>

      </div>
    </b-card>
  </b-container>
</template>
<script>
  import {
    FieldTableData
  } from "./MembershipFieldTable"
  export default {
    name: 'Membership',
    mixins: [FieldTableData],

    data: function() {
      return {
        mode: 'view',
        items: [],
        input: {
          id: null,
          icon: '',
          subscription_type: '',
          subscription_subtitle: '',
          respond_quota: null,
          monthly_price: null,
          annual_price: null
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {

      addNew() {
        let input = {
          id: null,
          subscription_type: '',
          icon: '',
          subscription_subtitle: '',
          respond_quota: null,
          monthly_price: null,
          annual_price: null
        }
        this.input = input
        this.mode = 'new'
      },
      back() {
        let input = {
          id: null,
          subscription_type: '',
          icon: '',
          subscription_subtitle: '',
          respond_quota: null,
          monthly_price: null,
          annual_price: null
        }
        this.input = input
        this.mode = 'view'
      },
      edit(item, index) {
        console.log(item);
        this.input.id = item.id
        this.input.subscription_type = item.subscription_type
        this.input.icon = item.icon
        this.input.subscription_subtitle = item.subscription_subtitle
        this.input.respond_quota = item.respond_quota
        this.input.monthly_price = item.monthly_price
        this.input.annual_price = item.annual_price
        this.index = index
        this.tableMode = false
        this.mode = 'edit'
      },
      getData() {
        axios.get(`/api/membership`)
          .then((response) => {
            this.items = response.data
            console.log(response.data)

          })
          .catch((error) => {
            console.log(error);
          })
      },
      handleSubmit() {

        if (this.mode == 'new') {
          axios.post(`/api/membership`, this.input)
            .then((response) => {
              console.log(response.data)
              this.items.push({
                id: response.data.data.id,
                subscription_type: this.input.subscription_type,
                icon: this.input.icon,
                subscription_subtitle: this.input.subscription_subtitle,
                respond_quota: this.input.respond_quota,
                monthly_price: this.input.monthly_price,
                annual_price: this.input.annual_price,
              })

              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })

        }
        if (this.mode == 'edit') {
          axios.patch(`/api/membership`, this.input)
            .then((response) => {
              console.log(response.data)
              this.items[this.index].subscription_type = this.input.id
              this.items[this.index].subscription_type = this.input.subscription_type
              this.items[this.index].icon = this.input.icon
              this.items[this.index].subscription_subtitle = this.input.subscription_subtitle
              this.items[this.index].respond_quota = this.input.respond_quota
              this.items[this.index].monthly_price = this.input.monthly_price
              this.items[this.index].annual_price = this.input.annual_price
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })

        }
        this.mode = 'view'

      },
      handleDelete(id, index) {
        axios.delete(`/api/membership/${id}`)
          .then((response) => {

            console.log(response.data)
            this.items.splice(index, 1)
            this.toastSuccess(response.data.message)
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
