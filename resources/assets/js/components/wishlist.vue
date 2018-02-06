<template>
       <button  @click.prevent="isWishlisted ? unWishlist(product) : wishlist(product)" :class="'btn btn-outline-secondary btn-sm btn-wishlist ' + (isWishlisted ? 'active' : '')" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>
</template>

<script>
    export default {
        props : ['product','wishlisted'],
        data : function() {
          return {
            isWishlisted: '',
          }
        },
        mounted() {
          this.isWishlisted = this.isWishlist ? true : false;
        },
        computed : {
          isWishlist()
          {
            return this.wishlisted;
          }
        },
        methods  : {
          wishlist(product) {
            this.isWishlisted = true;
            axios.post('/wishlist/'+product)
                  .then(response => console.log(response.data))
                  .catch(response => console.log(response.data));
          },
          unWishlist(product) {
            this.isWishlisted = false;
            axios.post('/unwishlist/'+product)
                  .then(response => this.isWishlisted = false)
                  .catch(response => console.log(response.data));
          }
        }
    }
</script>
