export const MyReviewTable = {
  data() {
    return {
      FieldTableItems: [{
          key: 'no',
          label: 'No',
          class: 'text-center',
          thStyle: {
            minWidth: '30px',
            width: '30px'
          }
        },
        {
          key: 'company.name',
          label: this.$options.filters.trans('dashboard.table.companyName'),
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '150px'
          }
        },
        {
          key: 'review_title',
          label: this.$options.filters.trans('dashboard.table.title'),
          thStyle: {
            minWidth: '175px',
            width: '175px'
          },
        },
        {
          key: 'insight',
          label: this.$options.filters.trans('dashboard.table.insight'),
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
          },
        },
        {
          key: 'rating',
          label: this.$options.filters.trans('dashboard.table.rating'),
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
          },
        },
        {
          key: 'type',
          label: this.$options.filters.trans('dashboard.table.type'),
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'status',
          label: this.$options.filters.trans('dashboard.table.status'),
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'answered',
          label: this.$options.filters.trans('dashboard.table.answered'),
          class: 'text-center',

          thStyle: {
            minWidth: '75px',
            width: '75px'
          },
        },

        {
          key: 'created_at',
          label: this.$options.filters.trans('dashboard.table.reviewDate'),
          class: 'text-center',
          thStyle: {
            minWidth: '150px',
            width: '150px'
          },
        },
        {
          key: 'action',
          label: '',
          class: 'text-center',
          thStyle: {
            minWidth: '75px',
            width: '75px'
          },
        },

      ],
      itemsData: [],
      selectedInputSearch: 'company',
      optionsInputSearch: [{
          value: 'company',
          text: this.$options.filters.trans('dashboard.table.company')
        },
        {
          value: 'title',
          text: this.$options.filters.trans('dashboard.table.title')
        },

      ],
    };
  },
  computed: {
    filteredItemsData() {
      if (this.selectedInputSearch == 'company') {
        return this.itemsData.filter(result =>
          result.company.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'title') {
        return this.itemsData.filter(result =>
          result.review_title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }

    }
  }
};
