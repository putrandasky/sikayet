export const instantSearch = {
  data() {
    return {
      search: this.$route.query.search || '',

    }
  },
  watch: {
    search(newVal) {
      let queryNewVal = Object.assign({}, this.$route.query, {
        searchKey: this.selectedInputSearch,
        search: newVal
      })
      if (newVal == '') {
        delete queryNewVal.searchKey
        delete queryNewVal.search
      }
      this.$router.replace({
        query: queryNewVal
      })
    }
  },
  computed: {
  }
}
