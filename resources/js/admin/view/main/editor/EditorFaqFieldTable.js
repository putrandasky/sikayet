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
          key: 'question',
          label: 'Question',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '150px',
          }
        },
        {
          key: 'answer',
          label: 'Answer',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
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
      ]
    };
  },

};
