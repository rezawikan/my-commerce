<template>
<div class="grid-item">
  <div class="product-card">
    <div v-if="catalog.discount != null" class="product-badge text-danger">{{ catalog.discount }}% Off</div>
    <a class="product-thumb" :href="catalog.category.slug+'/'+catalog.slug">
        <img :src="catalog.featured_image" alt="Product"></a>
    <h3 class="product-title"><a :href="catalog.category.slug+'/'+catalog.slug">{{ catalog.name }}</a></h3>
    <h4 class="product-price">
        <del v-if="catalog.discount != null">{{ catalog.price | toCurrency }}</del>
        {{ catalog.last_price | toCurrency }}
      </h4>
    <div class="product-buttons">
      <button @click.prevent="isWishlistFilter ? unWishlist(catalog.id) : wishlist(catalog.id)" :class="'btn btn-outline-secondary btn-sm btn-wishlist ' + (isWishlistFilter ? 'active' : '')" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
      <button class="btn btn-outline-primary btn-sm" @click.prevent="buy(catalog.id)">Add to Cart</button>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: [
    'catalog',
    'wishlisted'
  ],
  data: function() {
    return {

    }
  },
  computed: {
    isWishlistFilter() {
      for (var i = 0; i < this.wishlisted.length; i++) {
        if (this.wishlisted[i] == this.catalog.id) {
          return true;
        }
      }
      return false;
    }
  },
  filters: {
    toCurrency: function(value) {
      if (typeof value !== "number") {
        return value;
      }

      var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
      });
      return formatter.format(value);
    },
  },
  methods: {
    buy(value) {
      Event.$emit('buyItem', value);
    },
    wishlist(value) {
      Event.$emit('wishlistResponse', value);

      axios.post('/wishlist/' + value)
        .then(response => console.log('success'))
        .catch(response => console.log('failed'));
    },
    unWishlist(value) {
      Event.$emit('wishlistResponse', value);

      axios.post('/unwishlist/' + value)
        .then(response => this.isWishlisted = false)
        .catch(response => console.log('failed'));
    }
  },

}
</script>
