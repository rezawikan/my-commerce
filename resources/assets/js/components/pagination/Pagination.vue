<template>
<nav class="pagination">
  <div class="column">
    <ul class="pages">
      <li v-for="page in pagesNumber" :class="{ 'active': meta.current_page === page }">
        <a href="#" @click.prevent="switched(page)">{{ page }}</a>
      </li>
    </ul>
  </div>
</nav>
</div>
</template>

<script>
export default {
  props: {
    meta: {
      type: Object,
      required: true
    },
    offset: {
      type: Number,
      default: 4
    }

  },
  methods: {
    switched(page) {
      if (this.pageIsOutOfBounds(page)) {
        return;
      }


      this.$emit('pagination:switched', page)

      this.$router.replace({
        query: Object.assign({}, this.$route.query, {page})
      })
    },
    pageIsOutOfBounds(page) {
      return page <= 0 || page > this.meta.last_page
    }
  },
  computed: {
    pagesNumber() {
      if (!this.meta.to) {
        return [];
      }
      let from = this.meta.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      let to = from + (this.offset * 2);
      // console.log(to);
      if (to >= this.meta.last_page) {
        to = this.meta.last_page;
      }
      let pagesArray = [];
      for (let page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      // console.log(pagesArray);
      return pagesArray;
    }
  },
}
</script>
