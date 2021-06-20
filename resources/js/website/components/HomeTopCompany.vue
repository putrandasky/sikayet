<template>
  <div v-if="isLoaded">

    <b-card v-for="v,i in companies" :key="i" class="shadow-sm mb-3">
      <b-row>
        <b-col md="9">
          <b-row>
            <b-col md="3" class="justify-content-center d-flex align-items-center">
              <div class="border border-light p-2">
                <a class="text-dark" :href="`/brand/${v.slug}`">
                  <img v-if="v.avatar" class="img-fluid " :src="`/storage/company/${v.avatar}`" alt="">
                  <span v-else class="b-avatar badge-secondary rounded-sm" style="width:120px;height:120px"><i class="fa fa-briefcase fa-3x"></i></span>
                </a>
              </div>
            </b-col>
            <b-col md="9">
              <p class="h4">
                <strong>
                  <a class="text-dark" :href="`/brand/${v.slug}`">{{v.name}}</a>

                </strong>
              </p>
              <p>{{v.profile}}</p>
            </b-col>
          </b-row>
        </b-col>
        <b-col md="3" class="text-secondary">
          <div class="text-center">
            <small>
              Based on {{v.review}} reviews

            </small>
          </div>
          <div class="d-flex justify-content-center mb-1">
            <div v-for="j in v.rating_green" :key="'green'+j" class="bg-success rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
            <div v-for="j in v.rating_grey" :key="'grey'+j" class="bg-secondary rounded px-1 mr-1"><i class="fa fa-star text-white  "></i></div>
          </div>
          <div class="text-center text-secondary mb-2">
            Rating : {{v.rating}} of 5.0
          </div>
          <div class="text-center">
            <a class="btn btn-primary btn-sm" :href="`/brand/${v.slug}`">Read More</a>
          </div>
        </b-col>
      </b-row>
    </b-card>
    <div v-if="!isAllLoaded" class="text-center">
      <b-btn variant="primary" class="px-5" @click="updateData">Load More</b-btn>
    </div>
  </div>

</template>
<script>
  export default {
    name: 'HomeTopCompany',
    data: function() {
      return {
        isAllLoaded: false,
        step: 0,
        isLoaded: false,
        companies: []
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      async getData() {
        try {
          let response = await axios.get(`/top-company/${this.step}`)

          this.mutateKey(response.data)
          this.companies = response.data
          this.isLoaded = true
          this.step++

        } catch (error) {
          console.log(error);
        }
      },
      async updateData() {
        try {
          let response = await axios.get(`/top-company/${this.step}`)
          let data = Object.keys(response.data).map((k) => response.data[k]);
          if (data.length == 0) {
            this.isAllLoaded = true
          }
          this.mutateKey(data)
          for (let i = 0; i < data.length; i++) {
            this.companies.push(data[i]);
          }
          this.isLoaded = true
          this.step++
        } catch (error) {
          console.log(error);
        }
      },
      mutateKey(data) {
        data.forEach(function(obj) {
          obj.rating_green = parseInt(obj.rating.toFixed(0))
          obj.rating_grey = 5 - parseInt(obj.rating.toFixed(0))
        });

      },
    },
  }
</script>
<style>
</style>
