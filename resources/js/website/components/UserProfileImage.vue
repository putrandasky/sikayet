<template>
  <div style="height: auto;width:120px">
    <div class="position-relative">
      <b-img class="rounded-circle" v-if="updatedprofileimage" fluid :src="`/storage/user/${updatedprofileimage}`">
      </b-img>
      <b-avatar v-if="!updatedprofileimage" size="120px"><i class="fa fa-user fa-5x"></i> </b-avatar>
      <div class="btn--corner-offset">
        <div>
          <b-btn variant="success" class="btn--xs w-100" @click="isOpenModal=true"><i class="fa fa-edit"></i></b-btn>
        </div>
        <div>
          <b-btn v-if="updatedprofileimage" variant="danger" class="btn--xs w-100" @click="deleteProfileImage"><i class="fa fa-trash"></i></b-btn>
        </div>
      </div>
    </div>
    <b-modal size="sm" v-model="isOpenModal" @close="isOpenModal=false" hide-footer :title="'dashboard.avatarUpload.placeholder' | trans" class="position-relative">

      <file-upload :url="`/user-dashboard/profile-image`" @uploaded="changeProfileImage"></file-upload>
    </b-modal>
  </div>
</template>
<script>
  import FileUpload from './FileUpload.vue'
  export default {
    name: 'CompanyProfileImage',
    props: ['profileimage'],
    components: {
      FileUpload
    },
    data: function() {
      return {
        isOpenModal: false,
        updatedprofileimage: '',
      }
    },
    mounted() {
      this.updatedprofileimage = this.profileimage
      // console.log(this.currentProfileImage);
    },
    watch: {
      // currentProfileImage(newVal, oldVal) {
      //   this.profileImage = newVal
      //   console.log(newVal);
      // }
    },

    methods: {
      openModal() {
        this.isOpenModal = true
      },
      changeProfileImage(e) {
        this.updatedprofileimage = e.response.data
        this.toastSuccess(e.response.message)
        // this.isOpenModal = false
      },
      deleteProfileImage() {
        axios.delete(`/user-dashboard/profile-image`)
          .then((response) => {
            this.toastSuccess(response.data.message)
            this.updatedprofileimage = null

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
