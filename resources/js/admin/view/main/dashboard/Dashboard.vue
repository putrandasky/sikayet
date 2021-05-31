<template>
  <b-container class="py-3">
    <b-row>
      <b-col md="4">
        <panel title="Total User" variant="light" icon="users" data="200"></panel>
      </b-col>
      <b-col md="4">
        <panel title="Total Company" variant="light" icon="briefcase" data="50"></panel>
      </b-col>
      <b-col md="4">
        <panel title="Total Reviews" variant="light" icon="comments" data="1000"></panel>
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

                  <img class="img-fluid  rounded-circle" src="/images/websites/avatar.jpg">
                </div>
                <div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:40px;">From</div> : {{v.name}}
                  </div>
                  <div class="d-flex">
                    <div class=" mr-2" style="width:40px;">To</div> : {{v.company}}
                  </div>
                  <div>

                    <strong class="mb-0">{{v.title}}</strong>
                  </div>
                  <div class="text-muted">
                    {{v.description}}
                  </div>
                  <div class="d-flex justify-content-between">
                    <small class="d-flex">
                      Submited On :
                      {{v.created_at}}
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

                  <img class="img-fluid  rounded-circle" src="/images/websites/avatar.jpg">
                </div>
                <div>
                  <h3>{{v.name}}</h3>
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
                      {{v.created_at}}
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

                  <img class="img-fluid  rounded-circle" src="/images/websites/avatar.jpg">
                </div>
                <div>
                  <b>{{v.name}}</b>
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

                  <img class="img-fluid  rounded-circle" src="/images/websites/avatar.jpg">
                </div>
                <div>
                  <b>{{v.name}}</b>
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

                  <img class="img-fluid  rounded-circle" src="/images/websites/avatar.jpg">
                </div>
                <div>
                  <b>{{v.name}}</b>
                  <p class="mb-0 text-muted">Registered on : {{v.created_at}}</p>
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
        recent_review: [{
          name: 'John Doe',
          company: 'Good Company',
          title: 'Great Experience',
          description: 'Nebularis mushroom was photographed growing among fallen beech leaves in Famberhorst nature reserve, the Netherlands.',
          created_at: '21-Jul-21',
          rating: 5
        }],
        recent_companies: [{
          name: 'Good Company',
          category: 'Manufacturing',
          url: 'https://mygoodcompany.xyz',
          email: 'good_company@mail.com',
          created_at: '21-Jul-21'
        }],
        top_companies: [{
            name: 'Good Company',
            category: 'Food and Beverages',
            rating: 5,
            reviewed: 100
          },
          {
            name: 'Great Company',
            category: 'Electronic',
            rating: 4.5,
            reviewed: 300
          },
          {
            name: 'Amazing Company',
            category: 'Electronic',
            rating: 4.5,
            reviewed: 300
          },
          {
            name: 'Briliant Company',
            category: 'Electronic',
            rating: 4.5,
            reviewed: 200
          },
          {
            name: 'Nice Company',
            category: 'Electronic',
            rating: 4.5,
            reviewed: 100
          },
        ],
        most_reviewed_companies: [{
            name: 'Viral Company',
            category: 'Food and Beverages',
            rating: 4.5,
            reviewed: 1000
          },
          {
            name: 'Top Company',
            category: 'Electronic',
            rating: 4.0,
            reviewed: 900
          },
          {
            name: 'Busy Company',
            category: 'Food and Beverages',
            rating: 4.5,
            reviewed: 800
          },
          {
            name: 'Nice Company',
            category: 'Electronic',
            rating: 4.0,
            reviewed: 700
          },
          {
            name: 'My Company',
            category: 'Electronic',
            rating: 4.0,
            reviewed: 600
          }
        ],
        most_active_user: [{
            name: 'John Doe',
            created_at: '21-Jul-21',
            review: 200,
            useful: 1000
          },
          {
            name: 'Jane Doe',
            created_at: '21-Jul-21',
            review: 150,
            useful: 100
          },
          {
            name: 'Brandon Lee',
            created_at: '21-Jul-21',
            review: 100,
            useful: 100
          },
          {
            name: 'Brad Lee',
            created_at: '21-Jul-21',
            review: 100,
            useful: 100
          },
          {
            name: 'John Lee',
            created_at: '21-Jul-21',
            review: 100,
            useful: 100
          },
        ]
      }
    },
    created() {},
    methods: {},
  }
</script>
<style>
</style>
