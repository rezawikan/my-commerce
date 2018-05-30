<template>
<div class="">
  <div class="grid-item" v-if="layout == 'grid'">
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
        <button v-if="authorized" @click.prevent="isWishlistFilter ? unWishlist(catalog.id) : wishlist(catalog.id)" :class="'btn btn-outline-secondary btn-sm btn-wishlist ' + (isWishlistFilter ? 'active' : '')" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
        <button class="btn btn-outline-primary btn-sm" @click.prevent="buy(catalog.id)">Add to Cart</button>
      </div>
    </div>
  </div>

  <div class="product-card product-list" v-else-if="layout == 'list'">
    <a class="product-thumb">
      <div v-if="catalog.discount != null" class="product-badge text-danger">{{ catalog.discount }}% Off</div><img :src="catalog.featured_image" alt="Product"></a>
    <div class="product-info">
      <h3 class="product-title"><a :href="catalog.category.slug+'/'+catalog.slug">{{ catalog.name }}</a></h3>
      <h4 class="product-price">
        <del v-if="catalog.discount != null">{{ catalog.price | toCurrency }}</del>
        {{ catalog.last_price | toCurrency }}
      </h4>
      <p class="hidden-xs-down" v-text="catalog.description"></p>
      <div class="product-buttons">
        <button v-if="authorized" @click.prevent="isWishlistFilter ? unWishlist(catalog.id) : wishlist(catalog.id)" :class="'btn btn-outline-secondary btn-sm btn-wishlist ' + (isWishlistFilter ? 'active' : '')" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
        <button class="btn btn-outline-primary btn-sm" @click.prevent="buy(catalog.id)">Add to Cart</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import iziToast from 'izitoast'
export default {
  props: [
    'catalog',
    'wishlisted',
    'layout',
    'authorized'
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
      axios.post('/wishlist/' + value)
        .then(response => {
          Event.$emit('wishlistResponse', value);
          iziToast.success({
            title: 'Wishlisted',
            message: 'Successfully add to wishlist',
            backgroundColor: '#6eccf7'
          });
        })
        .catch(response =>
          iziToast.warning({
            title: 'Something Wrong',
            message: 'Check your internet connection',
            backgroundColor: '#6eccf7'
          })
        );
    },
    unWishlist(value) {
      axios.post('/unwishlist/' + value)
        .then(response => {
          this.isWishlisted = false;
          Event.$emit('wishlistResponse', value);
          iziToast.success({
            title: 'Unwishlisted',
            message: 'Successfully delete from wishlist',
            backgroundColor: '#6eccf7'
          });
        })
        .catch(response =>
          iziToast.warning({
            title: 'Something Wrong',
            message: 'Check your internet connection',
            backgroundColor: '#6eccf7'
          })
        );
    }
  },

}
</script>
