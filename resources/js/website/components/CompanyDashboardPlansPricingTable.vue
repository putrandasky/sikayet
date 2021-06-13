<template>
  <b-card>
    <b-card-text>
      <b-media>
        <template #aside>
          <i :class="`ri-${icon} fa-2x text-primary`"></i>
        </template>
        <h4 class="mb-0">
          <slot name="title"></slot>
        </h4>
        <div class="text-muted">
          <slot name="subtitle"></slot>
        </div>
      </b-media>
    </b-card-text>

    <b-card-text>
      <slot name="benefits"></slot>

    </b-card-text>
    <div class="w-100 text-center">
      <div class="mb-2">
        <slot name="buyMonthly"></slot>

      </div>
      <div>
        <slot name="buyAnnualy"></slot>

      </div>
    </div>
  </b-card>
</template>
<script>
  export default {
    name: 'CompanyDashboardPlansPricingTable',
    props: ['icon'],
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
