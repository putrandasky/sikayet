<template>
  <div>

    <div v-show="mode != 'view'">

      <b-form-group label="Question">
        <b-form-input v-model="input.question"></b-form-input>
      </b-form-group>
      <label>Answer</label>
      <tip-tap v-model="input.answer" />
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
        <template v-slot:cell(answer)="data">
          <div v-html="data.item.answer"></div>
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
  } from "./EditorFaqFieldTable"
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
          question: 'lorem ipsum',
          answer: 'dolor sit amet '
        }],
        input: {
          question: '',
          answer: ''
        }
      }
    },
    created() {},
    methods: {
      addNew() {
        this.tableMode = false
        this.input.question = ''
        this.input.answer = ''
        this.mode = 'new'
      },
      edit(item, index) {
        console.log(item);
        this.input.question = item.question
        this.input.answer = item.answer
        this.index = index
        this.tableMode = false
        this.mode = 'edit'
      },
      submit() {
        if (this.mode == 'new') {
          this.items.push({
            question: this.input.question,
            answer: this.input.answer,
          })
        }
        if (this.mode == 'edit') {
          this.items[this.index].question = this.input.question
          this.items[this.index].answer = this.input.answer
        }
        this.mode = 'view'

      }
    },
  }
</script>
<style>
</style>
