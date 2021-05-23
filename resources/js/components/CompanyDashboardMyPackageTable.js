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
          key: 'subscription_type',
          label: 'Subscription Type',

        },
        {
          key: 'last_payment',
          label: 'Last Payment',

        },
        {
          key: 'next_payment',
          label: 'Next Payment Date',
        },
        {
          key: 'payment_method',
          label: 'Payment Method',
        },


      ],

    };
  },
};
