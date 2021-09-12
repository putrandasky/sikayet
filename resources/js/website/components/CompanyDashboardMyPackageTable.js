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
          label: this.$options.filters.trans('subscription.name'),

        },
        {
          key: 'date_payment',
          label: this.$options.filters.trans('subscription.lastPayment'),

        },
        {
          key: 'ending_period',
          label: this.$options.filters.trans('subscription.endingPeriod'),
        },
        {
          key: 'payment_method',
          label: this.$options.filters.trans('subscription.paymentMethod'),
        },


      ],

    };
  },
};
