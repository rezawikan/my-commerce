<template>
<section class="widget widget-categories">
  <h3 class="widget-title">Price Range</h3>
  <button class="btn btn-outline-primary btn-sm" type="submit" @click.prevent="clearFilter('price')">Remove</button>
  <div class="price-range-slider">
    <vue-slider ref="slider" :min="min" :max="max" :tooltip="false" v-model="value"></vue-slider>
    <footer class="ui-range-slider-footer">
      <div class="column">
        <button class="btn btn-outline-primary btn-sm" type="submit" @click.prevent="priceFilter">Filter</button>
      </div>
      <div class="column">
        <div class="ui-range-values">
          <div class="ui-range-value-min"><span v-text="value[0]"></span>
            <input type="hidden" name="min">
          </div>&nbsp;-&nbsp;
          <div class="ui-range-value-max"><span v-text="value[1]"></span>
          </div>
        </div>
      </div>
    </footer>
  </div>
</section>
</template>

<script>
import vueSlider from 'vue-slider-component'
export default {
  components: {
    vueSlider,
  },
  data: function() {
    return {
      value: [5, 75],
      min: 0,
      max: 100,
      selectedFilters: {}
    }
  },
  watch: {
    '$route.query': {
      handler(query) {
        this.getDataMinMax()
      },
      deep: true
    }
  },
  mounted() {
    this.getDataMinMax();
  },
  methods: {
    priceFilter() {
      let price = this.value[0] + 'and' + this.value[1];
      this.selectedFilters = Object.assign({}, this.$route.query, {
        price
      });
      this.updateQueryString();
    },
    updateQueryString() {
      let filters = _.omit(this.selectedFilters, ['page']);
      this.$router.replace({
        query: {
          ...filters
        }
      })
    },
    getCurrentFilter(price = this.$route.query.price) {
      if (typeof price !== 'undefined' && price !== null) {
        let piece = price.split('and');
        this.value = [parseInt(piece[0]), parseInt(piece[1])];
      } else {
        this.value = [this.min, this.max];
      }
    },
    clearFilter(key) {
      let filters = _.omit(this.$route.query, key);
      this.$router.replace({
        query: {
          ...filters
        }
      })
    },
    getDataMinMax(params = this.$route.params.category) {
      axios.get('/api/catalogs/minmax/' + params)
        .then(response => {
          this.max = response.data.max;
          this.min = response.data.min;
          this.getCurrentFilter();
        })
        .catch(response => console.log('error'));
    }
  }
}
</script>
