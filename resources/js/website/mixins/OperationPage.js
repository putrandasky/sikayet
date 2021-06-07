export const OperationPage = {
  data() {
    return {
      isBusy: false,
      routeName: '',
      querySortDesc: '',
      querySortBy: '',
      currentPage: 1,
      perPage: 10,
      totalRows: 0
    };
  },
  created() {
    // this.getSort();
    // this.getData();
  },
  watch: {
    // '$route.query.sortDesc': 'getSort',
    // '$route.query.sortBy': 'getSort',
    // '$route.query.page': 'checkPage'
  },
  computed: {
    // checkNav() {
    //   return this.$route.query.filterTarget ?
    //     this.$route.query.filterTarget :
    //     'all';
    // },

    getTotalRows() {
      return this.filteredItemsData ? Math.ceil(this.filteredItemsData.length) : 0;
    },
    getTotalPages() {
      return this.filteredItemsData ? Math.ceil(this.filteredItemsData.length / this.perPage) : 1;
    }
  },
  methods: {
    onInput() {
      if (this.currentPage !== 1) {
        this.$router.replace({
          name: this.routeName,
          query: Object.assign({}, this.$route.query, {
            page: 1,
            search: this.search
          })
        });
        this.currentPage = 1;
      }
    },
    isActivePageButton(page) {
      return page == this.currentPage;
    },
    getRowCount(items) {
      return items.length;
    },
    checkPage() {
      this.currentPage = Number(
        this.$route.query.page ? this.$route.query.page : 1
      );
    },
    linkGen(pageNum) {
      return {
        name: this.routeName,
        query: Object.assign({}, this.$route.query, {
          page: pageNum
        })
      };
    },
    changePage(page) {
      // let query = Object.assign({},this.$route.query,page)
      // this.$router.push({page:query})
      // this.get(query)
      this.$router.replace({
        name: this.routeName,
        query: Object.assign({}, this.$route.query, {
          page: page
        })
      });
    },
    sortingChanged(ctx) {
      console.log(ctx);

      // console.log(ctx.sortBy);
      // console.log(ctx.sortDesc);
      this.$router.replace({
        // name: this.routeName,
        query: Object.assign({}, this.$route.query, {
          sortBy: ctx.sortBy,
          sortDesc: ctx.sortDesc
        })
      });
    },
    getSort() {
      let getOrderingDesc = JSON.parse(
        typeof this.$route.query.sortDesc === 'undefined' ?
        false :
        this.$route.query.sortDesc
      );
      let getOrderingBy = this.$route.query.sortBy ?
        this.$route.query.sortBy :
        '';
      // let convertGeOrderingDesc = getOrderingDesc == "true"
      this.querySortDesc = getOrderingDesc;
      this.querySortBy = getOrderingBy;
      // console.log(this.orderDesc);
    },
    // handleHeadClicked(key){
    //   console.log(key);
    //   // console.log(this.orderDesc);
    //     this.$router.replace({
    //     name: this.routeName,
    //     query: Object.assign({}, this.$route.query, {sortBy: key})
    //   })
    //   },
    filterTarget(target) {
      // console.log(target);
      if (
        target == this.$route.query.filterTarget ||
        (target == 'all' &&
          typeof this.$route.query.filterTarget === 'undefined')
      ) {
        return;
      }
      this.$router.replace({
        name: this.routeName,
        query: {
          filterTarget: target,
          page: 1
        }
      });
      this.search = '';
    },
  }
};
