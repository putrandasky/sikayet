<template>
  <div>

    <div v-show="mode != 'view'">

      <b-form-group label="Title">
        <b-form-input v-model="input.title"></b-form-input>
      </b-form-group>
      <label>Description</label>
      <tip-tap v-model="input.description" />
      <div class="float-right mt-3">
        <b-btn size="sm" variant="success" @click="submit">Submit</b-btn>
      </div>
    </div>
    <div v-show="mode == 'view'">
      <div class=" w-100 text-right mb-3">
        <b-btn class="" size="sm" variant="primary" @click="addNew">Add List</b-btn>
      </div>
      <b-table-lite :fields="FieldTableItems" :items="items">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
        </template>
        <template v-slot:cell(description)="data">
          <div v-html="data.item.description"></div>
        </template>
        <template v-slot:cell(action)="data">
          <b-btn size="sm" variant="success" @click="edit(data.item,data.index)">Edit</b-btn>
        </template>
      </b-table-lite>

    </div>
  </div>
</template>
<script>
  import TipTap from '../../../components/texteditor/TipTap.vue'
  import {
    FieldTableData
  } from "./EditorMembershipInfoFieldTable"
  export default {
    components: {
      TipTap
    },
    mixins: [FieldTableData],

    name: 'EditorFaq',
    data: function() {
      return {
        mode: 'view',
        index: null,
        items: [{
          title: 'lorem ipsum',
          description: 'dolor sit amet '
        }],
        input: {
          title: '',
          description: ''
        }
      }
    },
    created() {},
    methods: {
      addNew() {
        this.tableMode = false
        this.input.title = ''
        this.input.description = ''
        this.mode = 'new'
      },
      edit(item, index) {
        console.log(item);
        this.input.title = item.title
        this.input.description = item.description
        this.index = index
        this.tableMode = false
        this.mode = 'edit'
      },
      submit() {
        if (this.mode == 'new') {
          this.items.push({
            title: this.input.title,
            description: this.input.description,
          })
        }
        if (this.mode == 'edit') {
          this.items[this.index].title = this.input.title
          this.items[this.index].description = this.input.description
        }
        this.mode = 'view'

      }
    },
  }
</script>
<style>
</style>
