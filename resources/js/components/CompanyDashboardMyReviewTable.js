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
          key: 'rating',
          label: 'Rating',
          class: 'text-center',
          thStyle: {
            minWidth: '125px',
            width: '125px'
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
          key: 'status',
          label: 'Status',
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
            minWidth: '125px',
            width: '125px'
          },
        },

      ],
    };
  },
};
