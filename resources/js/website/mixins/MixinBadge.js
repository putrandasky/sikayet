export const Badge = {
  data() {
    return {};
  },
  created() {},
  methods: {
    getBadgeReviewType(status) {
      return status === "SOLUTION" ?
        "success" :
        status === "COMPLAIN" ?
        "danger" :
        "secondary";
    },
    getBadgeStatus(status) {
      return status === "PUBLISHED" ?
        "success" :
        status === "SUSPENDED" ?
        "danger" :
        "secondary";
    },
    getBadgeMembership(status) {
      return status === "PREMIUM" ?
        "primary" :
        status === "EXTENDED" ?
        "info" :
        status === "STANDARD" ?
        "success" : "secondary"
    },
  }
};
