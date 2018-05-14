<template>
<div class="cart">
  <a href="#"></a>
  <i class="icon-bag"></i>
  <span class="count" v-text="totalproduct"> </span>
  <span class="subtotal">{{ total | toCurrency}}</span>
  <div class="toolbar-dropdown">
    <div class="dropdown-product-item" v-for="(detail,index) in details">
      <span class="dropdown-product-remove"><i class="icon-cross" @click.prevent="deleteCart(detail.id, index)"></i></span>
      <a class="dropdown-product-thumb" href="#"><img :src="detail.detail.featured_image" alt="Product"></a>
      <div class="dropdown-product-info"><a class="dropdown-product-title" href="shop-single.html" v-text="detail.detail.name"></a><span class="dropdown-product-details">{{ detail.quantity }} x {{ detail.detail.last_price | toCurrency }}</span></div>
    </div>
    <div class="toolbar-dropdown-group">
      <div class="column"><span class="text-lg">Total:</span></div>
      <div class="column text-right"><span class="text-lg text-medium">{{ total | toCurrency}}</span></div>
    </div>
    <div class="toolbar-dropdown-group">
      <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="cart.html">View Cart</a></div>
      <div class="column"><a class="btn btn-sm btn-block btn-success" href="checkout-address.html">Checkout</a></div>
    </div>
  </div>
</div>
</template>

<script>
import iziToast from 'izitoast'
export default {
  components: {
    iziToast
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
    }
  },
  data: function() {
    return {
      details: [],
    }
  },
  computed: {
    total: function() {
      let amount = null;
      for (var i = 0; i < this.details.length; i++) {
        amount += this.details[i].subTotal;
      }
      return amount;
    },
    totalproduct: function() {
      return this.details.length;
    }
  },
  mounted() {
    this.getCart();
  },
  created: function() {
    // listen when pagination clicked
    Event.$on('buyItem', idCart => {
      iziToast.success({
        title: 'Added',
        message: 'Successfully add to cart',
        backgroundColor: '#6eccf7'
      });

      this.addCart(idCart);

    });
  },
  methods: {
    getCart() {
      axios.get('/api/cartdetails')
        .then(response => this.details = response.data)
        .catch(response => console.log('error'));
    },
    addCart(id) {
      axios.post('/api/cart', {
          product_id: id,
          quantity: 1
        })
        .then(response => {
          this.getCart();
        })
        .catch(response => console.log('error'));
    },
    deleteCart(id, index) {

      iziToast.warning({
        title: 'Deleted',
        message: 'Successfully delete to cart',
        backgroundColor: '#6eccf7'
      });

      axios.delete('/api/cart/' + id)
        .then(response => this.details.splice(index, 1))
        .catch(response => console.log('error'));
    }
  }
}
</script>
