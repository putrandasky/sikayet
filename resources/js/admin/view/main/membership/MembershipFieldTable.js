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
          key: 'subscription_type',
          label: 'Plan Name',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '125px',
          }
        },
        {
          key: 'subscription_subtitle',
          label: 'Subtitle',
          tdClass: 'truncate-cell',
          thStyle: {
            minWidth: '150px',
          }
        },
        {
          key: 'respond_quota',
          label: 'Quota',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'monthly_price',
          label: 'Monthly Price',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
          }
        },
        {
          key: 'annual_price',
          label: 'Annual Price',
          class: 'text-center',
          thStyle: {
            minWidth: '100px',
            width: '100px',
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
