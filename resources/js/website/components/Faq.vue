<template>
  <b-container style="min-height:100%">
    <b-row>
      <b-col md="3" class="d-md-block d-none">
        <b-list-group flush class="mt-3">
          <b-list-group-item v-for="(v,i) in data" :key="i" :href="`#${v.name}`">
            <span>{{v.name}} <i class="fa fa-chevron-right float-right"></i></span>
          </b-list-group-item>
        </b-list-group>
      </b-col>
      <b-col md="9">
        <div v-for="(v,i) in data" :key="i" :id="v.name">
          <div>
            <strong>{{v.name}}</strong>
          </div>
          <b-card v-for="(j,k) in v.editor_faqs" :key="`${i}${k}`" no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
              <b-button block v-b-toggle="`accordion-${i}${k}`" variant="light">{{j.question}}</b-button>
            </b-card-header>
            <b-collapse :id="`accordion-${i}${k}`" visible accordion="my-accordion" role="tabpanel">
              <b-card-body>
                <b-card-text v-html="j.answer"></b-card-text>
              </b-card-body>
            </b-collapse>
          </b-card>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
  export default {
    name: 'Faq',
    props: ['data'],
    data: function() {
      return {}
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
