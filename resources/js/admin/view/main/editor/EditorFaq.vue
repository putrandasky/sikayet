<template>
  <div>
    <div>

      <strong>Compose Frequently Asked Question</strong>
    </div>

    <b-overlay variant="dark" bg-color="dark" :show="!isLoaded" blur=""></b-overlay>
    <div v-show="mode != 'view'">
      <div class="my-3">
        <b-btn size="sm" variant="secondary" @click="back">Back</b-btn>
      </div>
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
        <b-btn class="" size="sm" variant="primary" @click="addNewGroup">Add Group</b-btn>
      </div>
      <div v-for="(v,i) in items" :key="i">
        <div>
          <p class="h3">{{v.name}}
            <b-btn size="sm" variant="success" @click="editGroup(v,i)"><i class="fa fa-edit"></i></b-btn>
            <b-btn v-if="v.editor_faqs.length == 0" size="sm" variant="danger" @click="handleDeleteFaqGroup(v.id,i)"><i class="fa fa-trash"></i></b-btn>
          </p>
        </div>
        <div class=" w-100 text-right mb-3">
          <b-btn class="" size="sm" variant="primary" @click="addNew(v.id,i)">Add List</b-btn>
        </div>
        <b-table-lite stacked="sm" small :fields="FieldTableItems" :items="v.editor_faqs" v-if="isLoaded && items.length > 0">
          <template v-slot:cell(no)="data">
            {{data.index+1}}
          </template>
          <template v-slot:cell(answer)="data">
            <div v-html="data.item.answer"></div>
          </template>
          <template v-slot:cell(action)="data">
            <div class="d-flex">
              <b-btn size="sm" variant="success" @click="edit(v.id,i,data.item,data.index)"><i class="fa fa-edit"></i></b-btn>
              <b-btn size="sm" variant="danger" @click="handleDelete(v.id,i,data.item.id,data.index)"><i class="fa fa-trash"></i></b-btn>
            </div>
          </template>
        </b-table-lite>
        <hr>
      </div>
      <b-alert show v-if="isLoaded && items.length == 0">
        <h4>No FAQ Data</h4>
        <hr>
        <div>
          List FAQ will be shown here
        </div>
      </b-alert>
    </div>
    <b-modal v-model="isFaqGroupModalShow" title="FAQ Group" @ok.prevent="submitFaqGroup">
      <b-form-group label="Group Name">
        <b-input v-model="inputFaqGroup.name"></b-input>
      </b-form-group>
    </b-modal>
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
        inputFaqGroup: {
          id: null,
          name: ''
        },
        indexFaqGroup: null,
        modeFaqGroup: 'new',
        isLoaded: false,
        isFaqGroupModalShow: false,
        mode: 'view',
        index: null,
        items: [],
        input: {
          id: null,
          question: '',
          answer: ''
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      addNewGroup() {
        this.isFaqGroupModalShow = true
        this.inputFaqGroup.name = ''
        this.inputFaqGroup.id = ''
        this.modeFaqGroup = 'new'
      },
      editGroup(item, index) {
        this.isFaqGroupModalShow = true
        this.inputFaqGroup.name = item.name
        this.inputFaqGroup.id = item.id
        this.indexFaqGroup = index
        this.modeFaqGroup = 'edit'

      },
      submitFaqGroup() {
        if (this.modeFaqGroup == 'new') {

          axios.post(`/api/compose-faq-group`, this.inputFaqGroup)
            .then((response) => {
              this.items.push({
                name: this.inputFaqGroup.name,
                id: response.data.data,
                editor_faqs: []
              })
              console.log(response.data)
              this.isFaqGroupModalShow = false
              this.toastSuccess(response.data.message)

            })
            .catch((error) => {
              console.log(error);
            })
        }
        if (this.modeFaqGroup == 'edit') {
          axios.patch(`/api/compose-faq-group/${this.inputFaqGroup.id}`, this.inputFaqGroup)
            .then((response) => {
              console.log(response.data)
              this.items[this.indexFaqGroup].name = this.inputFaqGroup.name
              this.isFaqGroupModalShow = false
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })
        }
      },
      handleDeleteFaqGroup(GroupId, GroupIndex) {
        axios.delete(`/api/compose-faq-group/${GroupId}`)
          .then((response) => {

            console.log(response.data)
            this.items.splice(GroupIndex, 1)
            this.toastSuccess(response.data.message)
          })
          .catch((error) => {
            console.log(error);
          })
      },
      addNew(GroupId, GroupIndex) {
        this.input.group_id = GroupId
        this.input.group_index = GroupIndex
        this.input.id = null
        this.input.question = ''
        this.input.answer = ''
        this.mode = 'new'
      },
      back() {
        let input = {
          id: null,
          question: '',
          answqer: '',
        }
        this.input = input
        this.mode = 'view'
      },
      edit(GroupId, GroupIndex, item, index) {
        console.log(item);
        this.input.group_id = GroupId
        this.input.group_index = GroupIndex
        this.input.question = item.question
        this.input.answer = item.answer
        this.input.id = item.id
        this.index = index
        this.mode = 'edit'
      },
      getData() {
        axios.get(`/api/compose-faq-group`)
          .then((response) => {
            this.isLoaded = true
            this.items = response.data
            console.log(response.data)

          })
          .catch((error) => {
            console.log(error);
          })
      },
      submit() {
        if (this.mode == 'new') {
          axios.post(`/api/compose-faq`, this.input)
            .then((response) => {
              console.log(response.data)
              this.items[this.input.group_index].editor_faqs.push({
                id: response.data.data,
                question: this.input.question,
                answer: this.input.answer,
                editor_faq_group_id: this.input.group_id,
              })
              this.mode = 'view'
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })
        }
        if (this.mode == 'edit') {
          axios.patch(`/api/compose-faq/${this.input.id}`, this.input)
            .then((response) => {
              console.log(response.data)
              this.items[this.input.group_index].editor_faqs[this.index].question = this.input.question
              this.items[this.input.group_index].editor_faqs[this.index].answer = this.input.answer
              this.mode = 'view'
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })

        }

      },
      handleDelete(GroupId, GroupIndex, itemId, index) {
        axios.delete(`/api/compose-faq/${itemId}`)
          .then((response) => {

            console.log(response.data)
            this.items[GroupIndex].editor_faqs.splice(index, 1)
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
