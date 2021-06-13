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
          key: 'date_payment',
          label: 'Last Payment',

        },
        {
          key: 'ending_period',
          label: 'Ending Period',
        },
        {
          key: 'payment_method',
          label: 'Payment Method',
        },


      ],

    };
  },
};
