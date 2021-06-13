<template>
  <div class="mb-3">

    <b-card v-show="!isPaymentProcess">

      <b-card-title>
        <strong>Company Plans</strong>
      </b-card-title>
      <b-card-text>

        Show that you care about your customers. Subscribe as a premium company and claim your page to take advantage of the membership.
      </b-card-text>
      <b-row class="mb-3">

        <b-col md="4" v-for="item ,i in items" :key="i">
          <pricing :icon="item.icon">
            <template v-slot:title>
              {{item.subscription_type}}
            </template>
            <template v-slot:subtitle>
              {{item.subscription_subtitle}}
            </template>
            <template v-slot:benefits>
              <ol class="pl-3">
                <li>Manage One Company</li>
                <li>Email Notifications when someone posts a new review to your company</li>
                <li>No ADS on your company page</li>
                <li>Reply to reviews in the name of your company</li>
                <li>Answer limit : <span v-if="item.respond_quota<0">No Limit</span>
                  <span v-if="item.respond_quota>=0">{{item.respond_quota}}</span>
                </li>
              </ol>
            </template>
            <template v-slot:buyMonthly>
              <div class="mb-2">
                {{item.monthly_price}} usd / Month
              </div>
              <b-btn size="sm" variant="dark" @click="buyMembership('monthly',item)">Buy Monthly</b-btn>
            </template>
            <template v-slot:buyAnnualy>
              <div class="mb-2">
                {{item.annual_price}} usd / 12 Month
              </div>
              <b-btn size="sm" variant="primary" @click="buyMembership('annualy',item)">Buy Annualy</b-btn>
            </template>

          </pricing>
        </b-col>


      </b-row>

    </b-card>
    <b-modal v-model="isShowSelectPaymentModal" hide-footer no-close-on-backdrop no-close-on-esc :hide-header-close="isProcessingCheckout">
      <template #modal-title>
        <strong>
          Payment Process
        </strong>
      </template>
      <div class="mb-3">

        <strong>Your Selected Package</strong>
      </div>
      <div class="d-flex justify-content-between ">
        <div>
          Subscription Name
        </div>
        <div>
          {{selectedItem.subscription_type}}
        </div>
      </div>
      <div class="d-flex justify-content-between ">
        <div>
          Subscription Period
        </div>
        <div>
          {{selectedPeriod}}
        </div>
      </div>
      <div class="d-flex justify-content-between ">
        <div>
          Respond Quota
        </div>
        <div>
          <span v-if="selectedItem.respond_quota == -1">No Limit</span>
          <span v-if="selectedItem.respond_quota > 0">{{selectedItem.respond_quota}}</span>

        </div>
      </div>
      <div class="d-flex justify-content-between ">
        <div>
          Amount
        </div>
        <div>
          $ <span v-if="selectedPeriod == 'annualy'">{{selectedItem.annual_price}}</span>
          <span v-if="selectedPeriod == 'monthly'">{{selectedItem.monthly_price}}</span>
        </div>
      </div>
      <hr>
      <div class="mb-3">
        <div class="mb-3">
          <strong>Payment Method</strong>
        </div>

        <div id="payment-method-area" class="text-center">

          <b-form-radio v-model="selectedPaymentMethod" value="stripe" button-variant="outline-primary" button>

            <div class="m-3 p-3">
              <div>
                <b-img fluid src="/images/websites/stripe-logo.png"></b-img>
              </div>
              <div>
                <strong>Pay with Stripe</strong>
              </div>
            </div>
          </b-form-radio>
          <b-form-radio v-model="selectedPaymentMethod" value="paypal" button-variant="outline-primary" button>
            <div class="m-3 p-3">
              <div>
                <img class="img-fluid" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_150x38.png" alt="PayPal" />
              </div>
              <strong>
                Pay with Paypal
              </strong>

            </div>
          </b-form-radio>
        </div>

      </div>
      <b-button variant="primary" block :disabled="isProcessingCheckout || selectedPaymentMethod == ''" @click="processingCheckout">
        <div v-show="isProcessingCheckout">
          <b-spinner small></b-spinner>
          Processing...
        </div>
        <div v-show="!isProcessingCheckout">
          Checkout </div>
      </b-button>
    </b-modal>


    <!-- <div v-show="isPaymentProcess" class="wrapper">
      <CardForm @submit="submitPayment" :form-data="formData" @input-card-number="updateCardNumber" @input-card-name="updateCardName" @input-card-month="updateCardMonth" @input-card-year="updateCardYear" @input-card-cvv="updateCardCvv" />
    </div>
    <b-overlay no-wrap :show="isPaymentProcessLoading" variant="light" rounded blur=""></b-overlay> -->

  </div>
</template>
<script>
  import {
    loadStripe
  } from '@stripe/stripe-js';
  import Pricing from './CompanyDashboardPlansPricingTable'
  import CardForm from './PaymentCardForm.vue'
  export default {
    name: 'CompanyDashboardPlans',
    components: {
      Pricing,
      CardForm
    },
    data: function() {
      return {
        selectedPaymentMethod: '',
        isProcessingCheckout: false,
        isPaymentProcessLoading: false,
        isShowSelectPaymentModal: false,
        items: [],
        selectedItem: {},
        selectedPeriod: '',
        isPaymentProcess: false,
        formData: {
          cardName: '',
          cardNumber: '',
          cardMonth: '',
          cardYear: '',
          cardCvv: ''
        },

      }
    },
    mounted() {
      this.getData()

    },
    methods: {
      processingCheckout() {
        this.isProcessingCheckout = true
        if (this.selectedPaymentMethod == 'stripe') {
          this.checkOutStripe()
        }
        if (this.selectedPaymentMethod == 'paypal') {
          this.checkoutPaypal()
        }
      },
      buyMembership(period, item) {
        // this.$emit('setpaymentprocess', true)
        // this.isPaymentProcess = true
        this.selectedItem = item
        this.selectedPeriod = period
        this.isShowSelectPaymentModal = true
      },
      checkoutPaypal() {
        axios.post(`/checkout-paypal`, {
            item: this.selectedItem,
            period: this.selectedPeriod
          })
          .then((response) => {
            console.log(response.data)
            window.open(response.data.data.result.links[1].href, '_self')
          })
          .catch((error) => {
            console.log(error);
          })
      },
      async checkOutStripe() {
        const stripe = await loadStripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

        axios.post(`/checkout`, {
            item: this.selectedItem,
            period: this.selectedPeriod
          })
          .then((response) => {
            console.log(response.data)
            return stripe.redirectToCheckout({
              sessionId: response.data.id
            });
          })
          .then((session) => {
            console.log(session)
            return stripe.redirectToCheckout({
              sessionId: session.id
            });
          })
          .catch((error) => {
            console.log(error);
          })
      },
      submitPayment() {
        // this.isPaymentProcessLoading = true
        // axios.post(`/payment`, {
        //     formData: this.formData,
        //     item: this.selectedItem,
        //     period: this.selectedPeriod
        //   })
        //   .then((response) => {
        //     console.log(response.data)
        //     this.getMembership()
        //   })
        //   .catch((error) => {
        //     console.log(error.response.data.message);
        //   })
      },
      getMembership() {
        axios.post(`/company-dashboard/buy-membership/${this.selectedPeriod}`, this.selectedItem)
          .then((response) => {
            console.log(response.data)
            this.$emit('updateQuota', response.data.data)
            this.toastSuccess(response.data.message)
            this.$emit('setpaymentprocess', false)
            this.isPaymentProcess = false
            this.isPaymentProcessLoading = false
          })
          .catch((error) => {
            console.log(error);
          })
      },
      getData() {
        axios.get(`/api/membership`)
          .then((response) => {
            this.items = response.data
            console.log(response.data)

          })
          .catch((error) => {
            console.log(error);
          })
      },
      updateCardNumber(val) {},
      updateCardName(val) {},
      updateCardMonth(val) {},
      updateCardYear(val) {},
      updateCardCvv(val) {}
    },
  }
</script>
<style lang="scss">
  #payment-method-area {
    .btn-outline-primary {
      color: #212529 !important;
      background-color: unset !important;

      &:hover {
        background-color: unset !important;

      }

      &:not(.active) {
        border: unset;
      }

      &.active {}
    }


  }
</style>
