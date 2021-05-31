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
            <b-btn size="sm" variant="success" @click="edit(data.item,data.index)">Edit</b-btn>
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
              <b-form-input v-model="input.plan_icon" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="3">
            <b-form-group label="Plan Name">
              <b-form-input v-model="input.plan_name" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="Plan Subtitle">
              <b-form-input v-model="input.plan_subtitle" type="text"></b-form-input>
            </b-form-group>
          </b-col>
          <b-col md="4">
            <b-form-group label="Answer Quota ">
              <b-input-group append="Answer / Month">
                <b-form-input v-model="input.answer_quota" type="number"></b-form-input>
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
          <b-btn size="sm" variant="primary" @click="submit">Submit</b-btn>
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
        items: [{
          id: null,
          plan_icon: '',
          plan_name: 'Standard',
          plan_subtitle: 'This is standard package',
          answer_quota: 10,
          monthly_price: 50,
          annual_price: 500
        }],
        input: {
          id: null,
          plan_icon: '',
          plan_name: '',
          plan_subtitle: '',
          answer_quota: null,
          monthly_price: null,
          annual_price: null
        }
      }
    },
    created() {},
    methods: {

      addNew() {
        let input = {
          id: null,
          plan_name: '',
          plan_icon: '',
          plan_subtitle: '',
          answer_quota: null,
          monthly_price: null,
          annual_price: null
        }
        this.input = input
        this.mode = 'new'
      },
      back() {
        let input = {
          id: null,
          plan_name: '',
          plan_icon: '',
          plan_subtitle: '',
          answer_quota: null,
          monthly_price: null,
          annual_price: null
        }
        this.input = input
        this.mode = 'view'
      },
      edit(item, index) {
        console.log(item);
        this.input.plan_name = item.plan_name
        this.input.plan_icon = item.plan_icon
        this.input.plan_subtitle = item.plan_subtitle
        this.input.answer_quota = item.answer_quota
        this.input.monthly_price = item.monthly_price
        this.input.annual_price = item.annual_price
        this.index = index
        this.tableMode = false
        this.mode = 'edit'
      },
      submit() {
        if (this.mode == 'new') {
          this.items.push({
            plan_name: this.input.plan_name,
            plan_icon: this.input.plan_icon,
            plan_subtitle: this.input.plan_subtitle,
            answer_quota: this.input.answer_quota,
            monthly_price: this.input.monthly_price,
            annual_price: this.input.annual_price,
          })
        }
        if (this.mode == 'edit') {
          this.items[this.index].plan_name = this.input.plan_name
          this.items[this.index].plan_icon = this.input.plan_icon
          this.items[this.index].plan_subtitle = this.input.plan_subtitle
          this.items[this.index].answer_quota = this.input.answer_quota
          this.items[this.index].monthly_price = this.input.monthly_price
          this.items[this.index].annual_price = this.input.annual_price
        }
        this.mode = 'view'

      }
    },
  }
</script>
<style>
</style>
