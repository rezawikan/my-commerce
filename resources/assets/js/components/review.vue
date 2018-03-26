<template>
<div class="tab-pane fade" id="reviews" role="tabpanel">
  <div class="comment" v-for="(detail,index) in details.data">
    <div class="comment-author-ava"><img :src="'/storage/users/'+detail.photo" alt="Review author"></div>
    <div class="comment-body">
      <div class="comment-header d-flex flex-wrap justify-content-between">
        <h4 class="comment-title" v-text="detail.subject"></h4>
        <div class="mb-2">
          <div class="rating-stars">
            <i class="icon-star" v-for="index in 5" :class="index < detail.rating ? 'filled' : ''"></i>
          </div>
        </div>
      </div>
      <p class="comment-text" v-text="detail.review"></p>
      <div class="comment-footer">
        <span class="comment-meta" v-text="detail.user_name"></span>
        <span class="comment-meta pull-right">{{detail.created_at}}</span>
      </div>
    </div>
  </div>
  <!-- Pagination Reviews -->
  <nav class="pagination">
    <div class="column text-center">
      <button class="btn btn-outline-secondary btn-sm" @click.prevent="prevPage(details.prev_page_url)" :class="details.prev_page_url == null ? 'disabled':''"><i class="icon-arrow-left"></i>&nbsp;Prev</button>
      <span> from {{details.from}} to {{details.to}} of {{details.total}} </span>
      <button class="btn btn-outline-secondary btn-sm" @click.prevent="nextPage(details.next_page_url)" :class="details.next_page_url == null ? 'disabled':''">Next&nbsp;<i class="icon-arrow-right"></i></button>
    </div>
  </nav>
</div>
</template>

<script>
export default {
  props: ['idProduct', 'authCheck'],
  data: function() {
    return {
      id: this.idProduct,
      details: [],
    }
  },
  mounted() {
    this.getRating();
  },
  methods: {
    getRating() {
      console.log(this.id);
      axios.get('/ratingdetails/' + this.id)
        .then(response => {
          this.details = response.data;
          console.log(response.data);
        })
        .catch(response => console.log('error'));
    },
    nextPage(link) {
      axios({
          method: 'get',
          url: link,
        })
        .then(response => {
          this.details = response.data;
          var el = document.getElementById("reviews");
          el.scrollIntoView({
            block: "center"
          });
          window.scroll(0, scrolledY - 83);
        });
    },
    prevPage(link) {
      axios({
          method: 'get',
          url: link,
        })
        .then(response => {
          this.details = response.data;
          var el = document.getElementById("reviews");
          el.scrollIntoView({
            block: "center"
          });
          window.scroll(0, scrolledY - 83);
        });
    }
  }
}
</script>
