export const OperationPage = {
  data() {
    return {
      isBusy: false,
      routeName: '',
      querySortDesc: '',
      querySortBy: this.$route.query.sortBy,
      currentPage: this.$route.query.page || 1,
      perPage: 10,
      totalRows: 0
    };
  },
  created() {
    this.getSort();
    this.getData();
  },
  watch: {
    '$route.query.sortDesc': 'getSort',
    '$route.query.sortBy': 'getSort',
    '$route.query.page': 'checkPage'
  },
  computed: {
    checkNav() {
      return this.$route.query.filterTarget ?
        this.$route.query.filterTarget :
        'all';
    },
    getTotalPages() {
      return Math.ceil(this.filteredItemsData.length / this.perPage);
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
    mutateKey(data) {
      let mutateData = data.map(function(item) {
        return {
          value: item.id,
          text: item.range || item.name || item.description,
          state: false
        };
      });
      return mutateData;
    },
    getPriority(data) {
      return data === 'high' ?
        'text-danger' :
        data === 'medium' ?
        'text-warning' :
        'text-primary';
    },
    getBadge(status) {
      return status === 'PUBLISH' ?
        'primary' :
        status === 'DRAFT' ?
        'secondary' :
        'success';
    },
    getBadgeActive(status) {
      return status ?
        'success' :
        'secondary';
    },
    getBadgeStatus(status) {
      return status === "ACTIVE" ?
        "success" :
        status === "SUSPENDED" ?
        "danger" :
        "secondary";
    },

    getBadgeReviewType(status) {
      return status === "SOLUTION" ?
        "success" :
        status === "COMPLAIN" ?
        "danger" :
        "secondary";
    },
    getBadgeReviewStatus(status) {
      return status === "PUBLISHED" ?
        "success" :
        status === "SUSPENDED" ?
        "danger" :
        "secondary";
    },
    getBadgeMembership(status) {
      return status === "PREMIUM" ?
        "primary" :
        status === "EXTENDED" ?
        "info" :
        status === "STANDARD" ?
        "success" : "secondary"
    },
    getBadgeApproval(status) {
      return status === 'APPROVED' ?
        'success' :
        status === 'IN PROGRESS' ?
        'warning' :
        status === 'SUBMITTED' ?
        'primary' :
        status === 'NOT APPROVED' ?
        'danger' :
        'secondary';
    }
  }
};
