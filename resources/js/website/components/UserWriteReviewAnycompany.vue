<template>
  <b-card>
    <b-form-group label="Company Name">
      <b-form-input v-model="input.company_name" placeholder="Please write the company name"></b-form-input>
    </b-form-group>
    <b-form-group label="Company Rating">
      <b-form-rating class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
    </b-form-group>
    <b-form-group label="Review Title">
      <b-form-input v-model="input.title" placeholder="What is your experience?"></b-form-input>
    </b-form-group>
    <b-form-group label="Your Review">
      <b-form-textarea v-model="input.description" rows="4" placeholder="Describe your review to help others"></b-form-textarea>
    </b-form-group>
    <b-form-group label="Type of Review">
      <b-form-select v-model="input.review_type_id" :options="review_type_options">
        <b-form-select-option :value="null" disabled>-- Please select type of Review --</b-form-select-option>
      </b-form-select>
    </b-form-group>
    <b-form-group label="Photo(optional)">
      <b-form-file ref="photo" name="photo" v-model="file" placeholder="Choose a file or drop it here..." drop-placeholder="Drop file here..." @change="onFileChange"></b-form-file>
    </b-form-group>
    <b-form-checkbox id="checkbox-1" v-model="input.accept_tnc" name="checkbox-1" value="accepted" unchecked-value="not_accepted">
      I agree the <b-link href="#" @click="tncModal=true">terms and condition</b-link> for my review
    </b-form-checkbox>
    <b-btn variant="primary" class="float-right" size="sm" @click="submit" :disabled="!input.rating || !input.title || !input.description || !input.review_type_id || input.accept_tnc == 'not_accepted'">
      Submit Review
    </b-btn>
    <b-modal size="lg" v-model="tncModal" hide-footer title="Terms and Condition">
      <div v-html="term"></div>
    </b-modal>
    <b-modal v-model="submitedModal" hide-footer @close="close" title="Thank you for your business review" no-close-on-backdrop no-close-on-esc>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />

      We will check your review for the company that not registered yet in our database. If approved, the review will be show on the main website under the company name you write before and it will be show in your dashboard.
      <br>
      have a nice day

    </b-modal>
    <b-overlay variant="dark" :show="isLoading" blur="" fixed no-wrap></b-overlay>
  </b-card>
</template>
<script>
  import animationData from "../assets/submit.js";
  import Lottie from 'vue-lottie'

  export default {
    name: 'UserWriteReview',
    props: ['reviewtype', 'term'],
    components: {
      Lottie
    },
    data: function() {
      return {
        defaultOptions: {
          animationData: animationData,
          loop: false
        },
        review_type_options: null,
        isLoading: false,
        submitedModal: false,
        maxFileSize: 1000,
        tncModal: false,
        file: null,
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
      this.review_type_options = this.mutateKey(this.reviewtype)

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
    },
  }
</script>
