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
          key: 'total_reviewed',
          label: 'Reviewed',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'total_complain',
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
          key: 'membership',
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
      ]
    };
  },

};
