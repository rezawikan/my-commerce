<template>
<section class="widget widget-categories">
  <h3 class="widget-title">Price Range</h3>
  <form class="price-range-slider" href="#">
    <div class="ui-range-slider"></div>
    <footer class="ui-range-slider-footer">
      <div class="column">
        <button class="btn btn-outline-primary btn-sm" type="submit">Filter</button>
      </div>
      <div class="column">
        <div class="ui-range-values">
          <div class="ui-range-value-min"><span></span>
            <input type="hidden" name="min">
          </div>&nbsp;-&nbsp;
          <div class="ui-range-value-max"><span></span>
            <input type="hidden" name="max">
          </div>
        </div>
      </div>
    </footer>
  </form>
</section>
</template>

<script>
import noUiSlider from 'nouislider'
export default {
  // props: [
  //   'catalog',
  //   'wishlisted'
  // ],
  directives: {
    noUiSlider,
  },
  data: function() {
    return {
      prices: {
        'min': 0,
        'max': 10000
      }
    }
  },
  created() {
    this.getDataMin();
    this.getDataMax();
  },
  mounted() {
    this.getSlider(this.prices.min, this.prices.max);
  },
  computed: {
    pricing() {
      let price = this.$route.query.price;
      if (typeof price !== 'undefined' && price !== null) {
        return price.split('and');
      }
      return ['100', '200'];
    },
  },
  methods: {
    getSlider(min, max) {
      let rangeSlider = document.querySelector('.ui-range-slider');
      let valueMin = document.querySelector('.ui-range-value-min span'),
        valueMax = document.querySelector('.ui-range-value-max span'),
        valueMinInput = document.querySelector('.ui-range-value-min input'),
        valueMaxInput = document.querySelector('.ui-range-value-max input');

      if (min != 0 && max != 0) {
        noUiSlider.create(rangeSlider, {
          start: [parseInt(this.pricing[0]), parseInt(this.pricing[1])],
          connect: true,
          step: 1,
          range: {
            'min': min,
            'max': max
          }
        });
      }
    },
    updateSliderRange(min, max) {
      updateSlider.noUiSlider.updateOptions({
        range: {
          'min': min,
          'max': max
        }
      });
    },
    getDataMin() {
      axios.get('/api/catalogs/' + this.$route.params.category + '/min')
        .then(response => {
          this.prices.min = response.data.data;
          console.log('test');
        })
        .catch(response => console.log('error'));
    },
    getDataMax() {
      axios.get('/api/catalogs/' + this.$route.params.category + '/max')
        .then(response => this.prices.max = response.data.data)
        .catch(response => console.log('error'));
    }
  }
}
</script>
