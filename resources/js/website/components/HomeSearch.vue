<template>
  <b-col lg="9">
    <b-form @submit="openCompaniesListing">
      <b-input-group>
        <!-- <b-input placeholder=" What are you looking for "></b-input> -->
        <vue-bootstrap-typeahead class="autocomplete" @keyup.native="onKeyUpSearchCompany" v-model="companySearch" :data="companies" :serializer="company => company.name" @hit="openCompany($event)" :minMatchingChars="3" placeholder="What company do you looking for">
          <template slot="suggestion" slot-scope="{ data, htmlText }">
            <div class="d-flex justify-content-between">

              <div v-html="htmlText"></div>
              <div>

                {{data.rating}} / 5.0
                <span v-for="v in data.rating_rounded " :key="v">
                  <i class="fa fa-star text-success"></i>
                </span>
              </div>
            </div>

          </template>
        </vue-bootstrap-typeahead>
        <!-- <strong v-show="searchingFeedback" slot="description" style="position: absolute;top: 55px;left: 29px;">
          Searching User ....
        </strong>
        <strong v-show="searchingFeedbackNoCompany" slot="description" style="position: absolute;top: 55px;left: 29px;color:red">
          There's No User With That Name!
        </strong> -->
        <!-- <template #append>
          <b-dropdown text="Categories" variant="light">
            <b-dropdown-item>Action A</b-dropdown-item>
            <b-dropdown-item>Action B</b-dropdown-item>
            <b-dropdown-item>Action C</b-dropdown-item>
          </b-dropdown>
          <b-button variant="primary">Search</b-button>

        </template> -->
      </b-input-group>
    </b-form>

  </b-col>
</template>
<script>
  import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
  import debounce from '../utils/debounce'
  export default {
    name: 'HomeSearch',
    components: {
      'vue-bootstrap-typeahead': VueBootstrapTypeahead
    },
    data: function() {
      return {
        data: this.dataProps,
        editPrModal: false,
        searchingFeedback: false,
        searchingFeedbackNoCompany: false,
        companies: [],
        companySearch: '',
        selectedCompany: null,
      }
    },
    created() {},
    computed: {

    },
    methods: {
      onKeyUpSearchCompany: debounce(function(event) {
        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >=
            97 && event.keyCode <= 122) || event.keyCode == 8 || event.keyCode == 229) {
          this.selectedCompany = null
          if (this.companySearch.length >= 3) {
            this.searchingFeedbackNoCompany = false
            this.searchingFeedback = true
            this.getCompany(this.companySearch)
          } else {
            this.searchingFeedbackNoCompany = false
            this.searchingFeedback = false
          }
        }
      }, 500),
      getInteger(a) {
        return a.toFixed(0)
      },
      getCompany(query) {
        let self = this
        axios.get('search?name=' + query)
          .then((response) => {
            console.log(response.data)
            if (response.data.length == 0) {
              this.searchingFeedback = false
              this.searchingFeedbackNoCompany = true
            }
            if (response.data.length !== 0) {
              self.companies = this.mutateKey(response.data)
              console.log(self.companies);
              this.searchingFeedback = false
            }
            // console.log(this.selectedCompany)
          })
          .catch((error) => {
            console.log(error);
          })
        // this.addresses = suggestions.suggestions
      },
      openCompany(data) {
        window.open(`/brand/${data.slug}`, '_self')
      },
      openCompaniesListing(e) {
        e.preventDefault()
        window.open(`/companies?name=${this.companySearch}`, '_self')
      },
      mutateKey(data) {
        let mutateData = data.map(function(item) {
          let parsedRating = parseFloat(item.rating)
          return {
            name: item.name,
            slug: item.slug,
            rating: item.rating,
            rating_rounded: parseInt(parsedRating.toFixed(0))
          };
        });
        return mutateData;
      },
    },
  }
</script>
<style lang="scss">
  .input-group .autocomplete {
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
    margin-bottom: 0;

    // input.form-control {
    //   border-top-right-radius: 0 !important;
    //   border-bottom-right-radius: 0 !important;
    // }
  }
</style>>
