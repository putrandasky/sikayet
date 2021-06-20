<template>
  <b-card title="Keywords">
    <div class="d-flex flex-wrap">

      <b-btn v-for="v,i in words" :key="i" variant="outline-secondary" class="mr-1 mb-1" @click="insertParam('key',v)">
        {{v}}
      </b-btn>

    </div>
  </b-card>
</template>
<script>
  export default {
    name: 'CommonWords',
    props: ['slug'],
    data: function() {
      return {
        words: []
      }
    },
    // mounted() {
    //   this.getData()
    // },
    watch: {
      slug: function(newValue, oldValue) {
        console.log(newValue);
        this.getData()
      }
    },
    mounted() {
      // console.log(this.slug)
      this.getData()
    },
    methods: {
      async getData() {
        try {
          const response = await axios.get(`/common-words/${this.slug}`)
          console.log(response.data);
          this.words = response.data
        } catch (error) {
          console.log(error);
        }
      },
      insertParam(key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);

        // kvp looks like ['key1=value1', 'key2=value2', ...]
        var kvp = document.location.search.substr(1).split('&');
        let i = 0;

        for (; i < kvp.length; i++) {
          if (kvp[i].startsWith(key + '=')) {
            let pair = kvp[i].split('=');
            pair[1] = value;
            kvp[i] = pair.join('=');
            break;
          }
        }

        if (i >= kvp.length) {
          kvp[kvp.length] = [key, value].join('=');
        }

        // can return this or...
        let params = kvp.join('&'); // reload page with new params
        document.location.search = params;
      }
    }
  }
</script>
<style>
</style>
