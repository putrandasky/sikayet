<template>
  <b-card>
    <b-card-title>
      <h3>
        <strong>Write Review of Good Company</strong>
      </h3>
    </b-card-title>
    <b-form-group label="Company Rating">
      <b-form-rating class="pl-0" icon-empty="star-fill" inline no-border variant="light" v-model="input.rating"></b-form-rating>
    </b-form-group>
    <b-form-group label="Review Title">
      <b-form-input v-model="input.title" placeholder="What is your experience?"></b-form-input>
    </b-form-group>
    <b-form-group label="Your Review">
      <b-form-textarea v-model="input.review" rows="4" placeholder="Describe your review to help others"></b-form-textarea>
    </b-form-group>
    <b-form-group label="Photo(optional)">
      <b-form-file v-model="input.file" placeholder="Choose a file or drop it here..." drop-placeholder="Drop file here..."></b-form-file>
    </b-form-group>
    <b-form-checkbox id="checkbox-1" v-model="input.accept_tnc" name="checkbox-1" value="accepted" unchecked-value="not_accepted">
      I agree the <b-link href="#" @click="tncModal=true">terms and condition</b-link> for my review
    </b-form-checkbox>
    <b-btn variant="primary" class="float-right" size="sm" @click="submit">
      Submit Review
    </b-btn>
    <b-modal v-model="tncModal" hide-footer title="Terms and Condition">
      Illud scripserit mei an, sea te sonet partem contentiones. Eu quo corrumpit euripidis, enim sadipscing eos an. Mucius doctus constituto pri at, ne cetero postulant pro. At vix utinam corpora, ea oblique moderatius usu. Vix id viris consul honestatis, an constituto deterruisset consectetuer pro.

    </b-modal>
    <b-modal v-model="submitedModal" hide-footer title="Thank you for your business review" no-close-on-backdrop>
      <lottie :options="defaultOptions" v-on:animCreated="handleAnimation" :height="200" />

      We will check and activate your review as soon as possible and we will inform you by e-mail.
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
    components: {
      Lottie
    },
    data: function() {
      return {
        defaultOptions: {
          animationData: animationData,
          loop: false
        },
        isLoading: false,
        submitedModal: false,
        tncModal: false,
        input: {
          rating: null,
          title: '',
          review: '',
          file: null,
          accept_tnc: 'not_accepted',
        }
      }
    },
    created() {},
    methods: {
      handleAnimation: function(anim) {
        this.anim = anim;
      },
      submit() {
        this.isLoading = true
        setTimeout(() => {
          this.isLoading = false
          this.submitedModal = true
        }, 1000);
      }
    },
  }
</script>
