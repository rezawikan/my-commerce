<template>
<div class="">
  <!-- Page Title-->
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>{{ this.$route.params.category | capitalize }}</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="separator">&nbsp;</li>
          <li><a href="#">{{this.$route.params.category  | capitalize }}</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
    <div class="row">
      <!-- Products-->
      <div class="col-xl-9 col-lg-8 order-lg-2">
        <!-- Shop Toolbar-->
        <div class="shop-toolbar padding-bottom-1x mb-2">
          <div class="column">
            <div class="shop-sorting">
              <label for="sorting">Sort by:</label>
              <select class="form-control" id="sorting" onchange="location=this.value">
                        <option>Avarage Rating</option>
                      </select>
              <span class="text-muted">Showing:&nbsp;</span><span>items</span>
            </div>
          </div>
          <div class="column">
            <div class="shop-view"><a class="grid-view active" href="shop-grid-ls.html"><span></span><span></span><span></span></a><a class="list-view" href="shop-list-ls.html"><span></span><span></span><span></span></a></div>
          </div>
        </div>
        <!-- Products Grid-->
        <div class="isotope-grid cols-3 mb-2">
          <div class="gutter-sizer"></div>
          <div class="grid-sizer"></div>
          <!-- Product-->
          <catalog v-for="catalog in catalogs" :catalog="catalog" :key="catalog.id" :wishlisted="wishlisted" v-images-loaded.on.progress="callbackImages"></catalog>
        </div>
        <!-- Pagination-->
        <pagination :meta="meta" :offset="3" v-on:pagination:switched="getCatalogs"></pagination>
      </div>
      <!-- Sidebar          -->
      <div class="col-xl-3 col-lg-4 order-lg-1">
        <aside class="sidebar">
          <div class="padding-top-2x hidden-lg-up"></div>
          <!-- Widget Categories-->
          <categories endpoint="/api/categories"></categories>

          <!-- Widget Price Range-->
          <price-filters></price-filters>

          <!-- Promo Banner-->
          <section class="promo-box">
            <span class="overlay-dark" style="opacity: .45;"></span>
            <div class="promo-box-content text-center padding-top-3x padding-bottom-2x">
              <h4 class="text-light text-thin text-shadow">New Collection of</h4>
              <h3 class="text-bold text-light text-shadow">Sunglassess</h3><a class="btn btn-sm btn-primary" href="#">Shop Now</a>
            </div>
          </section>
        </aside>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import Catalog from './partials/Catalog.vue'
import PriceFilters from './partials/PriceFilters.vue'
import Pagination from '../pagination/Pagination.vue'
import Categories from './partials/Categories.vue'
import Isotope from 'isotope-layout'
import imagesLoaded from 'vue-images-loaded'

export default {
  components: {
    Catalog,
    PriceFilters,
    Pagination,
    Categories,
    Isotope
  },
  directives: {
    imagesLoaded,
  },
  filters: {
    capitalize: function(value) {
      if (!value) return ''
      value = value.toString()
      return value.replace(/\b\w/g, l => l.toUpperCase())
    }
  },
  data() {
    return {
      catalogs: [],
      meta: {},
      isotope: null,
      wishlisted: {},
      authorized: false
    }
  },
  watch: {
    '$route.params': {
      handler(query) {
        this.getCatalogs()
      },
      deep: true
    },
    '$route.query': {
      handler(query) {
        this.getCatalogs()
      },
      deep: true
    }
  },
  mounted() {
    this.getCatalogs();
    this.getUser();
  },
  created: function() {
    // listen when pagination clicked
    Event.$on('wishlistResponse', value => {
      this.getUser();
    });
  },
  methods: {
    reLayoutTheGrid() {
      setTimeout(() => {
        let grid = document.querySelector('.isotope-grid');
        this.isotope = new Isotope(grid, {
          itemSelector: '.grid-item',
          transitionDuration: '0.7s',
          masonry: {
            columnWidth: '.grid-sizer',
            gutter: '.gutter-sizer',
          }
        });
      }, 1);
    },
    callbackImages() {
      this.reLayoutTheGrid();
    },
    getCatalogs(page = this.$route.query.page, filters = this.$route.query) {
      axios.get('/api/catalogs/' + this.$route.params.category, {
          params: {
            ...filters,
            page
          }
        })
        .then(response => {
          this.catalogs = response.data.data;
          this.meta = response.data.meta;
        })
        .catch(response => console.log('error'));
    },
    checkWishlist(value) {
      console.log(value);
      axios.post('/cwishlist/' + value)
        .then(response => this.wishlisted = response.data)
        .catch(response => console.log('you are not login'));
    },
    getUser() {
      axios.get('/api/user')
        .then(response => this.checkWishlist(response.data.id))
        .catch(response => console.log('you are not login'));
    }
  }
}
</script>
