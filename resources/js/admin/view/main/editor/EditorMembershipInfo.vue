<template>
  <div>
    <div>

      <strong>Compose Membership Information </strong>
    </div>

    <b-overlay variant="dark" bg-color="dark" :show="!isLoaded" blur=""></b-overlay>
    <div v-show="mode != 'view'">
      <div class="my-3">
        <b-btn size="sm" variant="secondary" @click="back">Back</b-btn>
      </div>
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
      <b-table-lite stacked="sm" small :fields="FieldTableItems" :items="items" v-if="isLoaded && items.length > 0">
        <template v-slot:cell(no)="data">
          {{data.index+1}}
        </template>
        <template v-slot:cell(description)="data">
          <div v-html="data.item.description"></div>
        </template>
        <template v-slot:cell(action)="data">
          <div class="d-flex">
            <b-btn size="sm" variant="success" @click="edit(data.item,data.index)"><i class="fa fa-edit"></i></b-btn>
            <b-btn size="sm" variant="danger" @click="handleDelete(data.item.id,data.index)"><i class="fa fa-trash"></i></b-btn>
          </div>
        </template>
      </b-table-lite>
      <b-alert show v-if="isLoaded && items.length == 0">
        <h4>No Membership Info Data</h4>
        <hr>
        <div>
          List of membership information will be shown here
        </div>
      </b-alert>
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
        isLoaded: false,
        mode: 'view',
        index: null,
        items: [],
        input: {
          id: null,
          title: '',
          description: ''
        }
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      addNew() {
        this.input.id = null
        this.input.title = ''
        this.input.description = ''
        this.mode = 'new'
      },
      back() {
        let input = {
          id: null,
          title: '',
          answqer: '',
        }
        this.input = input
        this.mode = 'view'
      },
      edit(item, index) {
        console.log(item);
        this.input.title = item.title
        this.input.description = item.description
        this.input.id = item.id
        this.index = index
        this.mode = 'edit'
      },
      getData() {
        axios.get(`/api/compose-membership-info`)
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
          axios.post(`/api/compose-membership-info`, this.input)
            .then((response) => {
              console.log(response.data)

              this.items.push({
                id: response.data.data,
                title: this.input.title,
                description: this.input.description,
              })
              this.mode = 'view'
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })
        }
        if (this.mode == 'edit') {
          axios.patch(`/api/compose-membership-info/${this.input.id}`, this.input)
            .then((response) => {
              console.log(response.data)
              this.items[this.index].title = this.input.title
              this.items[this.index].description = this.input.description
              this.mode = 'view'
              this.toastSuccess(response.data.message)
            })
            .catch((error) => {
              console.log(error);
            })

        }

      },
      handleDelete(id, index) {
        axios.delete(`/api/compose-membership-info/${id}`)
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
