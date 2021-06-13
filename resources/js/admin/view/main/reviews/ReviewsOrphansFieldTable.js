export const FieldTableData = {
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
          key: 'user.name',
          label: 'From',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '125px',
          }
        },
        {
          key: 'company_name',
          label: 'To',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '125px',
          }
        },
        {
          key: 'title',
          label: 'Title',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
          }
        },
        {
          key: 'review_type',
          label: 'Type',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '75px',
            width: '75px',
          }
        },
        {
          key: 'review_status',
          label: 'Status',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'rating',
          label: 'Rating',
          class: 'text-center',
          thStyle: {
            minWidth: '50px',
            width: '50px',
          }
        },
        {
          key: 'created_at',
          label: 'Submitted',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },

        {
          key: 'action',
          label: '',
          thStyle: {
            minWidth: '50px',
            width: '50px'
          },
        },
      ],
      itemsData: [],
      selectedInputSearch: this.$route.query.searchKey || 'name',
      optionsInputSearch: [{
          value: 'name',
          text: 'Name'
        },
        {
          value: 'company',
          text: 'Company'
        },
        {
          value: 'title',
          text: 'Title'
        },

      ],
    };
  },
  computed: {
    filteredItemsData() {
      if (this.selectedInputSearch == 'name') {
        return this.itemsData.filter(result =>
          result.user.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'company') {
        return this.itemsData.filter(result =>
          result.company_name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'title') {
        return this.itemsData.filter(result =>
          result.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }

    }
  }
};
