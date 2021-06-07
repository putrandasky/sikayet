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
          key: 'name',
          label: 'name',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
          },
          sortable: true
        },
        {
          key: 'email',
          label: 'Email',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
          },
          sortable: true
        },
        {
          key: 'review',
          label: 'Review',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          },
          sortable: true
        },
        {
          key: 'like',
          label: 'Like',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          },
          sortable: true
        },
        {
          key: 'dislike',
          label: 'Dislike',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          },
          sortable: true
        },
        {
          key: 'status',
          label: 'Status',
          class: 'text-center',

          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
          sortable: true
        },
        {
          key: 'created_at',
          label: 'Registered On',
          class: 'text-right',
          thStyle: {
            minWidth: '125px',
            width: '125px',
          },
          sortable: true
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
          value: 'email',
          text: 'Email'
        },

      ],
    };
  },
  computed: {
    filteredItemsData() {
      if (this.selectedInputSearch == 'name') {
        return this.itemsData.filter(result =>
          result.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'email') {
        return this.itemsData.filter(result =>
          result.email.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }

    }
  }
};
