<template>
<div class="cart"><a href="cart.html"></a><i class="icon-bag"></i><span class="count" v-text="totalproduct"> </span><span class="subtotal" v-text="total">  </span>
  <div class="toolbar-dropdown">
    <div class="dropdown-product-item" v-for="(detail,index) in details">
      <span class="dropdown-product-remove" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-cross" @click.prevent="deleteCart(detail.id, index)"></i></span>
      <a class="dropdown-product-thumb" href="shop-single.html"><img src="img/cart-dropdown/01.jpg" alt="Product"></a>
      <div class="dropdown-product-info"><a class="dropdown-product-title" href="shop-single.html" v-text="detail.detail.name"></a><span class="dropdown-product-details">{{ detail.quantity }} x {{ detail.detail.price }}</span></div>
    </div>
    <div class="toolbar-dropdown-group">
      <div class="column"><span class="text-lg">Total:</span></div>
      <div class="column text-right"><span class="text-lg text-medium" v-text="total"></span></div>
    </div>
    <div class="toolbar-dropdown-group">
      <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="cart.html">View Cart</a></div>
      <div class="column"><a class="btn btn-sm btn-block btn-success" href="checkout-address.html">Checkout</a></div>
    </div>
  </div>
</div>
</template>

<script>
export default {

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
  created : function(){
    // listen when pagination clicked
    Event.$on('AddId', idCart => {
      // console.log('log add cart emit');
      // console.log(idCart);
      this.addCart(idCart);

    });
  },
  methods: {
    getCart() {
      axios.get('/cartdetails')
        .then( response => {
          this.details = response.data;
          console.log(response.data);
        })
        .catch(response => console.log('error'));
    },
    addCart(id) {
      axios.post('/cart', {
          product_id: id,
          quantity: 1
        })
        .then(response => {
          console.log('brhasil melakukan POST');
          console.log(response.data);
          this.getCart();
        })
        .catch(response => console.log('false'));
    },
    deleteCart(id, index) {
      console.log(id);
      console.log(index);
      console.log('sd');
      axios.delete('/cart/' + id)
        .then(response => {
          this.details.splice(index, 1);
          console.log(response.data);
        })
        .catch(response => console.log('error'));
    }
  }
}
</script>
