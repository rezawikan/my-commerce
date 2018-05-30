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
              <select class="form-control" id="sorting" v-model="selectedFilters">
                    <option v-for="(option, index) in options" :value="index" v-text="option.name"></option>
              </select>
              <span class="text-muted">Showing:&nbsp;</span><span>{{meta.total}} items</span>
            </div>
          </div>
          <div class="column">
            <div class="shop-view">
              <a href="#" :class="'grid-view ' + (layout == 'grid' ? 'active' : '')" @click.prevent="setLayout('grid')"><span></span><span></span><span></span></a>
              <a href="#" :class="'list-view ' + (layout == 'list' ? 'active' : '')" @click.prevent="setLayout('list')"><span></span><span></span><span></span></a></div>
          </div>
        </div>
        <!-- Products Grid-->
        <div class="isotope-grid cols-3 mb-2">
          <div class="gutter-sizer"></div>
          <div class="grid-sizer"></div>
          <!-- Product-->
          <catalog v-for="catalog in catalogs" :catalog="catalog" :key="catalog.id" :wishlisted="wishlisted" v-images-loaded.on.progress="reLayoutTheCatalogs" :layout="layout" :authorized="authorized"></catalog>
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

          <!-- Widget Brand Filter-->
          <brand-filters></brand-filters>

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
import BrandFilters from './partials/BrandFilters.vue'
import Pagination from '../pagination/Pagination.vue'
import Categories from './partials/Categories.vue'
import Isotope from 'isotope-layout'
import imagesLoaded from 'vue-images-loaded'

export default {
  components: {
    Catalog,
    BrandFilters,
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
      authorized: false,
      options: {},
      selectedFilters: this.$route.query.sort || 'new',
      layout: null
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
    },
    selectedFilters: {
      handler(query) {
        console.log(query);
        this.sortBy(query);
      },
      deep: true
    },
    layout: function() {
      this.reLayoutTheCatalogs();
    }

  },
  computed: {
    view: function() {
      if (this.layout == 'grid') {
        return 'grid-item';
      } else {
        return 'product-list';
      }
    }
  },
  created: function() {
    setTimeout(() => {
      this.getLayout();
      this.getCatalogs();
      this.getUser();
      this.getSortFilters();
    }, 300);
    // listen when pagination clicked
    Event.$on('wishlistResponse', value => {
      this.getUser();
    });
  },
  methods: {
    reLayoutTheCatalogs() {
      setTimeout(() => {
        let grid = document.querySelector('.isotope-grid');
        this.isotope = new Isotope(grid, {
          itemSelector: '.' + this.view,
          transitionDuration: '0.7s',
          masonry: {
            columnWidth: '.grid-sizer',
            gutter: '.gutter-sizer',
          }
        });
      }, 1);
    },
    getCatalogs(page = this.$route.query.page, filters = this.$route.query) {
      axios.get('/api/catalogs/' + this.$route.params.category, {
          params: {
            ...filters,
            page
          }
        })
        .then(response => {
          this.catalogs = null;
          this.catalogs = response.data.data;
          this.meta = response.data.meta;
          console.log('berhasil catalog');
        })
        .catch(response => console.log('error catalogs'));
    },
    sortBy(sort) {
      let sorts = Object.assign({}, this.$route.query, {
        sort
      });

      let filters = _.omit(sorts, ['page']);

      this.$router.replace({
        query: {
          ...filters
        }
      })
    },
    getLayout() {
      axios.get('/api/layout/catalogs')
        .then(response => this.layout = response.data)
        .catch(response => console.log('you are not login'));
    },
    setLayout(data) {
      axios.get('/api/layout/catalogs/' + data)
        .then(response => this.layout = response.data)
        .catch(response => console.log('you are not login'));
    },
    checkWishlist(value) {
      axios.post('/cwishlist/' + value)
        .then(response => this.wishlisted = response.data)
        .catch(response => console.log('you are not login'));
    },
    getUser() {
      axios.get('/api/user')
        .then(response => {
          this.checkWishlist(response.data.id)
          this.authorized = true;
        })
        .catch(response => console.log('you are not login'));
    },
    getSortFilters() {
      axios.get('/api/sort/catalogs')
        .then(response => this.options = response.data.data)
        .catch(response => console.log('error'));
    }
  }
}
</script>
