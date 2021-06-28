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
          key: 'insight',
          label: 'Insight',
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
          },
        },
        {
          key: 'rating',
          label: 'Rating',
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
          },
        },
        {
          key: 'type',
          label: 'Type',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'status',
          label: 'Status',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px'
          },
        },
        {
          key: 'answered',
          label: 'Answered',
          class: 'text-center',

          thStyle: {
            minWidth: '75px',
            width: '75px'
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
