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
          key: 'review_title',
          label: 'Title',
          thStyle: {
            minWidth: '150px',
          },

        },
        {
          key: 'user.name',
          label: 'From',
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
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
            minWidth: '125px',
            width: '125px'
          },
        },
        {
          key: 'action',
          label: '',
          class: 'text-center',
          thStyle: {
            minWidth: '50px',
            width: '50px'
          },
        },

      ],
      itemsData: [],
      selectedInputSearch: 'title',
      optionsInputSearch: [{
          value: 'title',
          text: 'Title'
        },
        {
          value: 'from',
          text: 'From'
        },
        {
          value: 'type',
          text: 'Type'
        },
        {
          value: 'status',
          text: 'Status'
        },
        {
          value: 'answered',
          text: 'Answered'
        },

      ],
    };
  },
  computed: {
    filteredItemsData() {
      if (this.selectedInputSearch == 'title') {
        return this.itemsData.filter(result =>
          result.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'from') {
        return this.itemsData.filter(result =>
          result.user.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'type') {
        if (this.search == '') {
          return this.itemsData
        }
        return this.itemsData.filter(result =>
          result.review_type.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'status') {
        if (this.search == '') {
          return this.itemsData
        }
        return this.itemsData.filter(result =>
          result.review_status.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        )
      }
      if (this.selectedInputSearch == 'answered') {
        if (this.search == '') {
          return this.itemsData
        }
        return this.itemsData.filter(result =>
          this.search == 'true' ? result.company_respond !== null && Object.keys(result.company_respond).length > 0 : !result.company_respond
        )
      }

    }
  }
};
