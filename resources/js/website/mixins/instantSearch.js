export const instantSearch = {
  data() {
    return {
      search: '',

    }
  },
  watch: {
    search(newVal) {
      let queryNewVal = Object.assign({}, {
        searchKey: this.selectedInputSearch,
        search: newVal
      })
      if (newVal == '') {
        delete queryNewVal.searchKey
        delete queryNewVal.search
      }
    }
  },
  computed: {}
}
