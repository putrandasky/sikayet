<template>
  <b-container class="py-3">
    <b-row>
      <b-col md="4">
        <panel title="Total User" variant="light" icon="users" :data="summary.user"></panel>
      </b-col>
      <b-col md="4">
        <panel title="Total Company" variant="light" icon="briefcase" :data="summary.company"></panel>
      </b-col>
      <b-col md="4">
        <panel title="Total Reviews" variant="light" icon="comments" :data="summary.review"></panel>
      </b-col>
    </b-row>
    <b-row class="mt-3">
      <b-col md="6">
        <b-card>
          <b-card-title>Recent Review</b-card-title>
          <b-list-group flush>

            <b-list-group-item class="px-0" v-for="v,i in recent_review" :key="i">
              <div class="d-flex">
                <div class="bg-white mt-2 mr-3" style="height: auto;width:64px">
                  <b-img class="rounded rounded-circle" v-if="v.avatar" fluid :src="`/storage/user/${v.avatar}`" style="width: 64px;heigh:auto">
                  </b-img>
                  <b-avatar v-if="!v.avatar" size="64px"><i class="fa fa-user fa-2x"></i> </b-avatar>
                </div>
                <div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:40px;">From</div> : {{v.name}}
                  </div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:40px;">To</div> : {{v.company}}
                  </div>
                  <div>
                    <a class="text-dark" :href="`/review/${v.slug}`" target="blank">
                      <strong class="mb-0">{{v.title}}</strong>
                    </a>
                  </div>
                  <div class="text-muted">
                    {{v.description}}
                  </div>
                  <div class="d-flex justify-content-between">
                    <small class="d-flex">
                      Submited On :
                      {{v.created_at | dateFormated}}
                    </small>
                    <div class="d-flex ">
                      <i class=" fa fa-star  mr-1 text-muted"></i>
                      <h6 class="mb-0 text-muted">{{v.rating}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </b-list-group-item>

          </b-list-group>
        </b-card>
      </b-col>
      <b-col md="6">
        <b-card>
          <b-card-title>Recent Companies Registered</b-card-title>
          <b-list-group flush>

            <b-list-group-item class="px-0" v-for="v,i in recent_companies" :key="i">
              <div class="d-flex">
                <div class="bg-white mt-2 mr-3" style="height: auto;width:64px">
                  <b-img class="rounded rounded-circle" v-if="v.avatar" fluid :src="`/storage/user/${v.avatar}`" style="width: 64px;heigh:auto">
                  </b-img>
                  <b-avatar v-if="!v.avatar" size="64px"><i class="fa fa-briefcase fa-2x"></i> </b-avatar>
                </div>
                <div>
                  <a class="text-dark" :href="`/brand/${v.slug}`" target="blank">
                    <h3>{{v.name}}</h3>
                  </a>

                  <div class="text-muted">{{v.category}}</div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:60px;">Website</div> : {{v.url}}
                  </div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:60px;">Email</div> : {{v.email}}
                  </div>
                  <div>
                    <small>
                      Registered On :
                      {{v.created_at | dateFormated}}
                    </small>
                  </div>
                </div>

              </div>
            </b-list-group-item>

          </b-list-group>
        </b-card>
      </b-col>
    </b-row>
    <b-row class="mt-3">
      <b-col md="4">
        <b-card>
          <b-card-title>Top Rating Company</b-card-title>
          <b-list-group flush>

            <b-list-group-item class="px-0" v-for="v,i in top_companies" :key="i">
              <div class="d-flex">
                <div class="bg-white mt-2 mr-2" style="height: auto;width:30px">
                  <b-img class="rounded rounded-circle" v-if="v.avatar" fluid :src="`/storage/user/${v.avatar}`" style="width: 30px;heigh:auto">
                  </b-img>
                  <b-avatar v-if="!v.avatar" size="30px"><i class="fa fa-briefcase"></i> </b-avatar>
                </div>
                <div>
                  <a class="text-dark" :href="`/brand/${v.slug}`" target="blank"><b>{{v.name}}</b></a>
                  <p class="mb-0 text-muted">{{v.category}}</p>
                </div>
                <div class="ml-auto d-flex align-items-center">
                  <div>
                    <div class="d-flex justify-content-between align-items-center">
                      <i class=" fa fa-star  mr-1 "></i>
                      <h6 class="mb-0">{{v.rating}}</h6>
                    </div>
                    <div class="d-flex justify-content-between  align-items-center">
                      <i class=" fa fa-comments  mr-1 text-muted"></i>
                      <h6 class="mb-0  text-muted">{{v.reviewed}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </b-list-group-item>

          </b-list-group>
        </b-card>
      </b-col>
      <b-col md="4">
        <b-card>
          <b-card-title>Most Reviewed Company</b-card-title>
          <b-list-group flush>

            <b-list-group-item class="px-0" v-for="v,i in most_reviewed_companies" :key="i">
              <div class="d-flex">
                <div class="bg-white mt-2 mr-2" style="height: auto;width:30px">

                  <b-img class="rounded rounded-circle" v-if="v.avatar" fluid :src="`/storage/user/${v.avatar}`" style="width: 30px;heigh:auto">
                  </b-img>
                  <b-avatar v-if="!v.avatar" size="30px"><i class="fa fa-briefcase"></i> </b-avatar>
                </div>
                <div>
                  <a class="text-dark" :href="`/brand/${v.slug}`" target="blank"><b>{{v.name}}</b></a>
                  <p class="mb-0 text-muted">{{v.category}}</p>
                </div>
                <div class="ml-auto d-flex align-items-center">
                  <div>
                    <div class="d-flex justify-content-between  align-items-center">
                      <i class=" fa fa-comments  mr-1 "></i>
                      <h6 class="mb-0  ">{{v.reviewed}}</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <i class=" fa fa-star  mr-1 text-muted"></i>
                      <h6 class="mb-0 text-muted">{{v.rating}}</h6>
                    </div>

                  </div>
                </div>
              </div>
            </b-list-group-item>

          </b-list-group>
        </b-card>
      </b-col>
      <b-col md="4">
        <b-card>
          <b-card-title>Most Active User</b-card-title>
          <b-list-group flush>

            <b-list-group-item class="px-0" v-for="v,i in most_active_user" :key="i">
              <div class="d-flex">
                <div class="bg-white mt-2 mr-2" style="height: auto;width:30px">

                  <b-img class="rounded rounded-circle" v-if="v.avatar" fluid :src="`/storage/user/${v.avatar}`" style="width: 30px;heigh:auto">
                  </b-img>
                  <b-avatar v-if="!v.avatar" size="30px"><i class="fa fa-user"></i> </b-avatar>
                </div>
                <div>
                  <a class="text-dark" :href="`/user/${v.slug}`" target="blank"><b>{{v.name}}</b></a>
                  <p class="mb-0 text-muted">Registered on : {{v.created_at | dateFormated}}</p>
                </div>
                <div class="ml-auto d-flex align-items-center">
                  <div>
                    <div class="d-flex justify-content-between  align-items-center">
                      <i class=" fa fa-comments  mr-1 "></i>
                      <h6 class="mb-0  ">{{v.review}}</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <i class=" fa fa-thumbs-up  mr-1 text-muted"></i>
                      <h6 class="mb-0 text-muted">{{v.useful}}</h6>
                    </div>

                  </div>
                </div>
              </div>
            </b-list-group-item>

          </b-list-group>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
  import Panel from './DashboardPanel'
  export default {
    name: 'Dashboard',
    components: {
      Panel
    },
    data: function() {
      return {
        summary: {
          user: 0,
          company: 0,
          review: 0
        },
        recent_review: [],
        recent_companies: [],
        top_companies: [],
        most_reviewed_companies: [],
        most_active_user: []
      }
    },
    mounted() {
      this.getData()
    },
    methods: {
      getData() {
        axios.get(`/api/dashboard`)
          .then((response) => {
            this.summary = response.data.summary
            let dataRecentReview = response.data.recent.review
            let recent_review = {
              name: dataRecentReview.user.name,
              company: dataRecentReview.company.name,
              title: dataRecentReview.title,
              slug: dataRecentReview.slug,
              description: dataRecentReview.description,
              created_at: dataRecentReview.created_at,
              avatar: dataRecentReview.avatar,
              rating: dataRecentReview.rating
            }
            this.recent_review[0] = recent_review
            let dataRecentCompany = response.data.recent.company_registered
            let recent_companies = {
              name: dataRecentCompany.name,
              category: dataRecentCompany.business_category.name,
              url: dataRecentCompany.website,
              slug: dataRecentCompany.slug,
              email: dataRecentCompany.email,
              avatar: dataRecentReview.avatar,
              created_at: dataRecentCompany.created_at
            }
            this.recent_companies[0] = recent_companies
            let dataTopCompanies = response.data.top.company_rating
            this.top_companies = dataTopCompanies.map(obj => {
              return {
                name: obj.name,
                category: obj.business_category.name,
                rating: obj.rating,
                slug: obj.slug,
                avatar: obj.avatar,
                reviewed: obj.review
              }
            });
            let dataTopReviewCompanies = response.data.top.company_review
            this.most_reviewed_companies = dataTopReviewCompanies.map(obj => {
              return {
                name: obj.name,
                category: obj.business_category.name,
                rating: obj.rating,
                slug: obj.slug,
                avatar: obj.avatar,
                reviewed: obj.review
              }
            });
            let dataTopUserReviewed = response.data.top.user_review
            this.most_active_user = dataTopUserReviewed.map(obj => {
              return {
                name: obj.name,
                slug: obj.slug,
                useful: obj.like,
                created_at: obj.created_at,
                review: obj.review,
                avatar: obj.avatar
              }
            });
            console.log(this.top_companies)

          })
          .catch((error) => {
            console.log(error);
          })
      }
    },
  }
</script>
<style>
</style>
