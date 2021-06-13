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
          }
        },
        {
          key: 'email',
          label: 'Email',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
          }
        },
        {
          key: 'verified',
          label: 'Verified',
          class: 'text-center',

          thStyle: {
            minWidth: '75px',
            width: '75px',
          }
        },
        {
          key: 'rating',
          label: 'Rating',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'review',
          label: 'Reviewed',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'review_general',
          label: 'General',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'review_solution',
          label: 'Solution',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'review_complaint',
          label: 'Complain',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        // {
        //   key: 'status',
        //   label: 'Status',
        //   class: 'text-center',
        //   thStyle: {
        //     minWidth: '100px',
        //     width: '100px'
        //   },
        // },
        {
          key: 'membership_active',
          label: 'Membership',
          class: 'text-center',

          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'created_at',
          label: 'Registered On',
          class: 'text-right',
          thStyle: {
            minWidth: '150px',
            width: '150px',
          },
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
