<template>
  <div>
    <b-btn :disabled="isDisabled" variant="light" size="sm" @click="submit('like')"><i class=" fa fa-thumbs-up"></i> {{review.useful}}
      <b-badge>{{currentlike}}</b-badge>
    </b-btn>
    <b-btn :disabled="isDisabled" variant="light" size="sm" @click="submit('dislike')"><i class=" fa fa-thumbs-down"></i> {{review.notUseful}}
      <b-badge>{{currentdislike}}</b-badge>
    </b-btn>
  </div>
</template>
<script>
  export default {
    name: 'CompanyDetailReviewAction',
    props: {
      review_owner_id: {
        type: Number,
        required: true,
      },
      user: {
        type: Object,
        default: null,
      },
      review_id: {
        type: Number,
        required: true,
      },
      proplike: {
        type: Number,
      },
      propdislike: {
        type: Number,
      },
    },
    data: function() {
      return {
        like: 0,
        dislike: 0
      }
    },
    computed: {
      currentlike() {
        return this.proplike + this.like
      },
      currentdislike() {
        return this.propdislike + this.dislike
      },
      isDisabled() {
        return this.user && Object.keys(this.user).length > 0 ? (this.review_owner_id == this.user.id ? true : false) : true
      }

    },
    methods: {
      submit(action) {
        axios.post(`/give-review-response`, {
            action: action,
            review_id: this.review_id
          })
          .then((response) => {
            console.log(response.data)
            this[action] += 1
            this.toastSuccess(response.data.message)

          })
          .catch((error) => {
            console.log(error);
            this.toastError(error.response.data.message)

          })
      }
    },
  }
</script>
<style>
</style>
