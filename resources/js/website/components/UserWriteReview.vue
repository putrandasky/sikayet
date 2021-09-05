<template>
  <b-card>
    <b-card-title>
      <h3>
        <strong>{{'review.writeFor' | trans}} {{companyname}}</strong>
      </h3>
    </b-card-title>
    <b-form-group :label="'review.companyRating' | trans">
      <b-form-rating class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
    </b-form-group>
    <b-form-group :label="'review.TitleLabel' | trans">
      <b-form-input v-model="input.title" :placeholder="'review.TitlePlaceholder' | trans"></b-form-input>
    </b-form-group>
    <b-form-group :label="'review.DescriptionLabel' | trans">
      <b-form-textarea v-model="input.description" rows="4" :placeholder="'review.DescriptionLabelPlaceholder' | trans"></b-form-textarea>
    </b-form-group>
    <b-form-group :label="'review.PhotoReviewLabel' | trans">
      <b-form-file :browse-text="'common.uploadFile' | trans" ref="photo" name="photo" v-model="file" :placeholder="'review.PhotoReviewPlaceholder' | trans" @change="onFileChange"></b-form-file>
    </b-form-group>
    <b-form-group :label="'review.SelectTypeLabel' | trans">
      <b-form-select v-model="input.review_type_id" :options="review_type_options">
        <b-form-select-option :value="null" disabled>-- {{'review.SelectTypePlaceholder' | trans}} --</b-form-select-option>
      </b-form-select>
    </b-form-group>
    <b-form-checkbox id="checkbox-1" v-model="input.accept_tnc" name="checkbox-1" value="accepted" unchecked-value="not_accepted">
      {{'review.tnc.iAgree' | trans}}
      <b-link href="#" @click="tncModal=true">{{'review.tnc.tnc' | trans}}</b-link> {{'review.tnc.forMyReview' | trans}}
    </b-form-checkbox>
    <b-btn variant="primary" class="float-right" size="sm" @click="submit" :disabled="!input.rating || !input.title || !input.description || !input.review_type_id || input.accept_tnc == 'not_accepted'">
      {{'review.submitReview' | trans}}
    </b-btn>
    <b-modal size="lg" v-model="tncModal" hide-footer :title="'review.tnc.tnc' | trans">
      <div v-html="term"></div>
    </b-modal>
    <b-modal v-model="submitedModal" hide-footer @close="backToCompanyDetail" :title="'review.postReview.title' | trans" no-close-on-backdrop no-close-on-esc>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />

      {{'review.postReview.Message1' | trans}}
      {{'review.postReview.Message2' | trans}}

    </b-modal>
    <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>
    <b-modal :visible="!isLoggedIn" hide-footer hide-header no-close-on-backdrop content-class="bg-transparent border-0" body-class="d-flex justify-content-center">
      <div>
        <user-login v-show="authMode == 'login'" :hideRegisterLink="true" :targetWindowReload="`/brand/${this.slug}/write-review`" :socialLoginStatus="socialLoginStatus"></user-login>
        <user-register v-show="authMode == 'register'" :hideLoginLink="true" :targetWindowReload="`/brand/${this.slug}/write-review`" :socialLoginStatus="socialLoginStatus"></user-register>
        <b-card body-class="py-2" style="margin-top:-4px;border-top-left-radius:unset;border-top-right-radius:unset">
          <div class="text-center" v-show="authMode == 'register'">
            {{'auth.alreadyHaveAccount' | trans}}
            <b-link @click="authMode = 'login'">{{'auth.signIn' | trans}}</b-link>
          </div>
          <div class="text-center" v-show="authMode == 'login'">
            {{'auth.dontHaveAccount' | trans}}
            <b-link @click="authMode = 'register'">{{'auth.signUp' | trans}}</b-link>
          </div>
        </b-card>
      </div>
    </b-modal>
  </b-card>
</template>
<script>
  import animationData from "../assets/submit.js";
  import Lottie from 'vue-lottie'
  import UserLogin from './UserLogin.vue'
  import UserRegister from './UserRegister.vue'
  export default {
    name: 'UserWriteReview',
    props: ['companyid', 'slug', 'companyname', 'reviewtype', 'term', 'socialLoginStatus', 'isLoggedIn'],
    components: {
      Lottie,
      UserLogin,
      UserRegister
    },
    data: function() {
      return {
        defaultOptions: {
          animationData: animationData,
          loop: false
        },
        authMode: 'login',
        review_type_options: null,
        isLoading: false,
        submitedModal: false,
        tncModal: false,
        maxFileSize: 1000,
        file: null,
        input: {
          company_id: null,
          rating: null,
          title: '',
          description: '',
          accept_tnc: 'not_accepted',
          review_type_id: null,
        }
      }
    },
    created() {},
    mounted() {
      this.review_type_options = this.mutateKey(this.reviewtype)
      this.input.company_id = this.companyid

    },
    methods: {
      onFileChange(e) {
        const file = e.target.files[0];
        if (file.size > this.maxFileSize * 1024) {
          this.toastError(`Maximum file size is ${this.$options.filters.formatSize(this.maxFileSize * 1024)}`, 'ERROR');
          this.$refs.photo.reset()
          e.preventDefault();
          return;
        }
        console.log(e.target.files.length);
        this.file = file
      },
      handleAnimation: function(anim) {
        this.anim = anim;
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          return {
            value: item.id,
            text: item.range || item.name || item.description,
            state: false
          };
        });
        return mutateData;
      },
      backToCompanyDetail() {
        window.open(`/brand/${this.slug}`, '_self')
      },
      submit() {
        this.isLoading = true
        let itemInput = JSON.stringify(this.input);
        let form = new FormData();
        form.append("itemInput", itemInput);
        form.append('itemFile', this.file);

        axios.post(`/brand/${this.companyid}/write-review`, form, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then((response) => {
            console.log(response.data)
            this.isLoading = false
            this.submitedModal = true
          })
          .catch((error) => {
            console.log(error);
          })

      }
    },
  }
</script>
