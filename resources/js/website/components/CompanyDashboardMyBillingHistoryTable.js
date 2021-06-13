export const MyPackageTable = {
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
          key: 'date_payment',
          label: 'Date Payment',
          class: 'text-center',
        },
        {
          key: 'payment_invoice',
          label: 'Invoice',
        },
        {
          key: 'subscription_type',
          label: 'Subscription Type',
        },
        {
          key: 'respond_quota',
          label: 'Respond Quota',
        },
        {
          key: 'payment_method',
          label: 'Payment Method',
          class: 'text-center',
        },
        {
          key: 'status',
          label: 'Status',
          class: 'text-center',
        },
        {
          key: 'payment_status',
          label: 'Payment Status',
          class: 'text-center',
        },
        {
          key: 'amount',
          label: 'Amount',
          class: 'text-right',

        },


      ],

    };
  },
};
