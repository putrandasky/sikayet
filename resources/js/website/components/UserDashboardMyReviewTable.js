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
          key: 'company_name',
          label: 'Company Name',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '150px'
          }
        },
        {
          key: 'review_title',
          label: 'Title',
          thStyle: {
            minWidth: '175px',
            width: '175px'
          },

        },
        {
          key: 'rating',
          label: 'Rating',
          thStyle: {
            minWidth: '150px',
            width: '150px'
          },
        },
        {
          key: 'type',
          label: 'Type',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'status',
          label: 'Status',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },


        {
          key: 'created_at',
          label: 'Review Date',
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
