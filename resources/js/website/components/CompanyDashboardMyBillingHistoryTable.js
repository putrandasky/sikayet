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
          label: this.$options.filters.trans('subscription.datePayment'),
          class: 'text-center',
        },
        {
          key: 'payment_invoice',
          label: this.$options.filters.trans('subscription.invoice'),
        },
        {
          key: 'subscription_type',
          label: this.$options.filters.trans('subscription.name'),
        },
        {
          key: 'respond_quota',
          label: this.$options.filters.trans('subscription.respondQuota'),
        },
        {
          key: 'payment_method',
          label: this.$options.filters.trans('subscription.paymentMethod'),
          class: 'text-center',
        },
        {
          key: 'status',
          label: this.$options.filters.trans('subscription.paymentMethod'),
          class: 'text-center',
        },
        {
          key: 'payment_status',
          label: this.$options.filters.trans('subscription.paymentStatus'),
          class: 'text-center',
        },
        {
          key: 'amount',
          label: this.$options.filters.trans('subscription.amount'),
          class: 'text-right',

        },


      ],

    };
  },
};
