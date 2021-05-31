<template>
  <div>
    <h3>Stripe</h3>
    <b-form-group label="Stripe Key">
      <b-form-input></b-form-input>
    </b-form-group>
    <b-form-group label="Stripe Secret">
      <b-form-input></b-form-input>
    </b-form-group>
    <hr>
    <h3>Paypal</h3>
    <b-form-group label="Paypal Key">
      <b-form-input></b-form-input>
    </b-form-group>
    <b-form-group label="Paypal Secret">
      <b-form-input></b-form-input>
    </b-form-group>
  </div>
</template>
<script>
  export default {
    name: 'ThirdPartiesPayment',
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
