<template>
  <b-modal v-model="isOpenModalPayment" title="Payment" @ok.prevent="submit" hide-header @show="modalShow">

    <label for="card-element">Card</label>
    <div id="card-element"></div>
  </b-modal>
</template>
<script>
  import {
    loadStripe
  } from '@stripe/stripe-js';


  export default {
    name: 'CompanyModalPayment',
    data: function() {
      return {
        isOpenModalPayment: false,
      }
    },
    mounted() {

    },
    methods: {
      async modalShow() {
        const stripe = await loadStripe('pk_test_51J0g2kAgrRxk9jofBdEJeURZ50rHKjYZQHQM0RQ7vrlzp2YPhLiRjutRYNO2y9JIf2lbiLdz9IMvR71o7d1j6PxK00XGiK9H06');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
      },
      openModalPayment() {
        this.isOpenModalPayment = true
      },
      submit() {
        console.log('submit');
        const cardElement = elements.getElement('card');
        console.log(cardElement);
      }
    },
  }
</script>
<style>
</style>
