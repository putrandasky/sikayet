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
          key: 'last_payment',
          label: 'Last Payment',
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
          key: 'payment_method',
          label: 'Payment Method',
        },
        {
          key: 'payment_status',
          label: 'Status',
        },
        {
          key: 'payment_amount',
          label: 'Amount',
        },


      ],

    };
  },
};
