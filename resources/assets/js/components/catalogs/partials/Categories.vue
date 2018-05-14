<template>
<section class="widget widget-categories">
  <h3 class="widget-title">Shop Categories</h3>
  <ul>
    <li v-for="value, key in filters" :class="expandMenu(key, key)">
      <a href="#" @click.prevent="switchedCategory(key)">{{key | capitalize }}</a>
      <span>({{value.total}})</span>
      <ul>
        <li v-for="subvalue, subkey in value.value">
          <a href="#" :class="checkExpand(subkey,key)" @click.prevent="switchedCategory(subkey)">{{ subkey | capitalize }}</a>
          <span>({{subvalue.total}})</span>
          <ul>
            <li v-for="lastvalue in subvalue.childs">
              <a href="#" :class="checkExpand(subkey,key)" @click.prevent="switchedCategory(lastvalue)">{{lastvalue | capitalize }}</a>
            </li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</section>
</template>

<script>
export default {
  props: [
    'endpoint'
  ],
  filters: {
    capitalize: function(value) {
      if (!value) return ''
      value = value.toString()
      return value.replace(/\b\w/g, l => l.toUpperCase())
    }
  },
  data() {
    return {
      filters: {},
      categories: '',
      expand : 'false'
    }
  },
  mounted() {
    axios.get(this.endpoint)
    .then(response => this.filters = response.data.data)
    .catch(response => console.log('failed'));
  },
  methods: {
    switchedCategory(value) {

      this.$router.replace({
        params: {
          category: value
        }
      })
    },
    checkExpand(value, key) {
      let cat = this.$route.params.category;
      if (cat == value) {
        this.categories = key
      }

    },
    expandMenu(value, key) {
      this.checkExpand(value, key)

      if (this.categories == value) {
        return 'has-children expanded'
      }
      return 'has-children'
    }
  }
}
</script>
