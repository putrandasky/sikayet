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
          key: 'item',
          label: 'Item',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '175px',
            width: '175px',
          }
        },
        {
          key: 'description',
          label: 'Description',
          thStyle: {
            minWidth: '200px',
          },
        },
        {
          key: 'due_date',
          label: 'Due Date',
          thStyle: {
            minWidth: '200px',
            width: '200px'
          },
        },
      ]
    };
  },

};
