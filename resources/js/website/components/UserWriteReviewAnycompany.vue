<template>
  <b-card>
    <b-form-group :label="'auth.companyName' | trans">
      <!-- <b-form-input v-model="input.company_name" placeholder="Please write the company name"></b-form-input> -->

      <vue-bootstrap-typeahead class="autocomplete" @keyup.native="onKeyUpSearchCompany" v-model="input.company_name" :data="companies" :serializer="company => company.name" @hit="openCompany($event)" :minMatchingChars="3" :placeholder="'review.searchCompanyPlaceholder' | trans">
        <template slot="suggestion" slot-scope="{ data, htmlText }">
          <div class="d-flex justify-content-between">

            <div v-html="htmlText"></div>
            <div>

              {{data.rating}} / 5.0
              <span v-for="v in data.rating_rounded " :key="v">
                <i class="fa fa-star text-success"></i>
              </span>
            </div>
          </div>

        </template>
      </vue-bootstrap-typeahead>

    </b-form-group>
    <b-form-group :label="'review.companyRating' | trans">
      <b-form-rating class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
    </b-form-group>
    <b-form-group :label="'review.TitleLabel' | trans">
      <b-form-input v-model="input.title" :placeholder="'review.TitlePlaceholder' | trans"></b-form-input>
    </b-form-group>
    <b-form-group :label="'review.DescriptionLabel' | trans">
      <b-form-textarea v-model="input.description" rows="4" :placeholder="'review.DescriptionLabelPlaceholder' | trans"></b-form-textarea>
    </b-form-group>
    <b-form-group :label="'review.SelectTypeLabel' | trans">
      <b-form-select v-model="input.review_type_id" :options="review_type_options">
        <b-form-select-option :value="null" disabled>-- {{'review.SelectTypePlaceholder' | trans}} --</b-form-select-option>
      </b-form-select>
    </b-form-group>
    <b-form-group :label="'review.PhotoReviewLabel' | trans">
      <b-form-file :browse-text="'common.uploadFile' | trans" ref="photo" name="photo" v-model="file" :placeholder="'review.PhotoReviewPlaceholder' | trans" drop-placeholder="Drop file here..." @change="onFileChange"></b-form-file>
    </b-form-group>
    <b-form-checkbox id="checkbox-1" v-model="input.accept_tnc" name="checkbox-1" value="accepted" unchecked-value="not_accepted">
      {{'review.tnc.iAgree' | trans}}
      <b-link href="#" @click="tncModal=true">{{'review.tnc.tnc' | trans}}</b-link> {{'review.tnc.forMyReview' | trans}}
    </b-form-checkbox>
    <b-btn variant="primary" class="float-right" size="sm" @click="submit" :disabled="!input.rating || !input.title || !input.description || !input.review_type_id || input.accept_tnc == 'not_accepted' || companies.length > 0 || input.company_name == ''">
      {{'review.submitReview' | trans}}
    </b-btn>
    <b-modal size="lg" v-model="tncModal" hide-footer :title="'review.tnc.tnc' | trans">
      <div v-html="term"></div>
    </b-modal>
    <b-modal v-model="submitedModal" hide-footer @close="close" :title="'review.postReview.title' | trans" no-close-on-backdrop no-close-on-esc>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />

      {{'review.postReview.Message3' | trans}}

      <br>
      {{'review.postReview.Message2' | trans}}

    </b-modal>
    <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>
    <b-modal :visible="!isLoggedIn" hide-footer hide-header no-close-on-backdrop content-class="bg-transparent border-0" body-class="d-flex justify-content-center">
      <div>
        <a class="position-absolute text-secondary" style="right:80px;top: 40px;z-index:1" href="/">
          <i class="fa fa-close "></i>
        </a>
        <user-login v-show="authMode == 'login'" :hideRegisterLink="true" :targetWindowReload="`/write-review`" :socialLoginStatus="socialLoginStatus"></user-login>
        <user-register v-show="authMode == 'register'" :hideLoginLink="true" :targetWindowReload="`/write-review`" :socialLoginStatus="socialLoginStatus"></user-register>
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
  import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
  import debounce from '../utils/debounce'
  import UserLogin from './UserLogin.vue'
  import UserRegister from './UserRegister.vue'
  export default {
    name: 'UserWriteReview',
    props: ['reviewtype', 'term', 'socialLoginStatus', 'isLoggedIn'],
    components: {
      Lottie,
      'vue-bootstrap-typeahead': VueBootstrapTypeahead,
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
        maxFileSize: 1000,
        tncModal: false,
        file: null,
        searchingFeedback: false,
        searchingFeedbackNoCompany: false,
        companies: [],
        selectedCompany: null,
        input: {
          review_type_id: null,
          company_name: '',
          rating: null,
          title: '',
          description: '',
          accept_tnc: 'not_accepted',
        }
      }
    },
    mounted() {
      this.review_type_options = this.mutateReviewTypeKey(this.reviewtype)

    },
    methods: {
      handleAnimation: function(anim) {
        this.anim = anim;
      },
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
      close() {
        window.open(`/`, '_self')
      },
      submit() {
        this.isLoading = true
        let itemInput = JSON.stringify(this.input);
        let form = new FormData();
        form.append("itemInput", itemInput);
        form.append('itemFile', this.file);

        axios.post(`/write-review`, form, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then((response) => {
            console.log(response.data)
            this.isLoading = false
            this.submitedModal = true
            setTimeout(() => {
              window.open(`/user-dashboard`, '_self')

            }, 5000);
          })
          .catch((error) => {
            console.log(error);
          })

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
      mutateReviewTypeKey(data) {
        let self = this
        let mutateData = data.map(function(item) {
          return {
            value: item.id,
            text: self.$options.filters.trans(`review.reviewType.${item.name}`),
            state: false
          };
        });
        return mutateData;
      },
      onKeyUpSearchCompany: debounce(function(event) {
        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >=
            97 && event.keyCode <= 122) || event.keyCode == 8 || event.keyCode == 229) {
          this.selectedCompany = null
          if (this.input.company_name.length >= 3) {
            this.searchingFeedbackNoCompany = false
            this.searchingFeedback = true
            this.getCompany(this.input.company_name)
          } else {
            this.searchingFeedbackNoCompany = false
            this.searchingFeedback = false
          }
        }
      }, 500),
      getInteger(a) {
        return a.toFixed(0)
      },
      getCompany(query) {
        let self = this
        axios.get('search?name=' + query)
          .then((response) => {
            console.log(response.data)
            if (response.data.length == 0) {
              this.searchingFeedback = false
              this.searchingFeedbackNoCompany = true
              self.companies = []
            }
            if (response.data.length !== 0) {
              self.companies = this.mutateCompanyNameKey(response.data)
              console.log(self.companies);
              this.searchingFeedback = false
            }
            // console.log(this.selectedCompany)
          })
          .catch((error) => {
            console.log(error);
          })
        // this.addresses = suggestions.suggestions
      },
      openCompany(data) {
        window.open(`/brand/${data.slug}`, '_self')
      },
      mutateCompanyNameKey(data) {
        let mutateData = data.map(function(item) {
          let parsedRating = parseFloat(item.rating)
          return {
            name: item.name,
            slug: item.slug,
            rating: item.rating,
            rating_rounded: parseInt(parsedRating.toFixed(0))
          };
        });
        return mutateData;
      },
    },
  }
</script>
