<template>
    <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topCenter" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!" @click.prevent="buy(idCart)">Add to Cart</button>
</template>

<script>
    export default {
        props : {
          'idCart' : {
            type: String,
            required : true,
          }
        },
        methods : {
          buy(idCart) {
            console.log(idCart);
            Event.$emit('AddId', idCart);
          }
        }
    }
</script>
