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
            minWidth: '175px'
          }
        },
        {
          key: 'review_title',
          label: 'Title',
          thStyle: {
            minWidth: '150px',
            width: '150px'
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
            minWidth: '175px',
            width: '175px'
          },
        },

      ],

    };
  },
};
