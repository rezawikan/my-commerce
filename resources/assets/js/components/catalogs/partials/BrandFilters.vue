<template>
<section class="widget">
  <h3 class="widget-title">Filter by Brand</h3>
  <label class="custom-control custom-checkbox d-block" v-for="brand in brands">
      <input class="custom-control-input" type="checkbox" :value="brand.slug" v-model="checked"><span class="custom-control-indicator"></span><span class="custom-control-description" v-text="brand.title">&nbsp;<span class="text-muted">(254)</span></span>
  </label>
</section>
</template>

<script>
export default {
  props: [

  ],
  data: function() {
    return {
      brands: {},
      checked: [],
      converted: null
    }
  },
  watch: {
    checked: function() {
      this.setBrand();
    }
  },
  created() {
    setTimeout(() => {
      this.getBrand()
    }, 300);

  },
  computed: {

  },
  filters: {

  },
  methods: {
    setBrand() {
      this.converted = this.checked.toString();
      this.converted = this.converted.replace(/,/g, '--');
      let brands, filters = null;
      if (this.converted.length > 0) {
        brands = Object.assign({}, this.$route.query, {
          brand: this.converted
        });

        filters = _.omit(brands, ['page']);
      } else {
        filters = _.omit(this.$route.query, ['brand', 'page']);
        console.log(filters);
      }

      this.$router.replace({
        query: {
          ...filters
        }
      })
    },
    getBrand() {
      axios.get('/api/brands/catalogs')
        .then(response => this.brands = response.data.data)
        .catch(response => console.log('error'));

      console.log(this.$route.query.brand);
    }
  }

}
</script>
