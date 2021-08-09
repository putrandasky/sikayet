<template>
  <b-modal v-model="openModal" :title="title" @ok="ok" @cancel="cancel" no-close-on-backdrop no-close-on-esc hide-header-close :ok-title="'common.ok' | trans" :cancel-title="'common.cancel' | trans">

    <slot name="body">

    </slot>
  </b-modal>
</template>
<script>
  export default {
    name: 'SlotConfirmationModal',
    props: ['title'],
    data: function() {
      return {
        openModal: false
      }
    },
    created() {},
    methods: {
      ok(e) {
        e.preventDefault()
        this.$emit('ok')
      },
      cancel() {
        this.openModal = false
      }
    },
  }
</script>
<style>
</style>
