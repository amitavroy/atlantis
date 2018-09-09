<template>
  <div class="card gallery-card" style="width: 18rem;">
    <div class="gallery-card-image">
      <img class="card-img-top"
           v-bind:src="thumbnail"
           alt="Card image cap">
    </div>
    <div class="card-body">
      <h5 class="card-title">{{gallery.name}}</h5>
      <p><i class="fa fa-image"></i> {{count}}</p>
      <p class="card-text">{{gallery.description}}</p>
      <a v-bind:href="gallery.slug" class="btn btn-primary">View gallery</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ['gallery'],

  computed: {
    count() {
      return (this.gallery.photos && this.gallery.photos.length) ? this.gallery.photos.length : 0;
    },
    thumbnail() {
      return (this.gallery.thumbnail.thumb) ? this.gallery.thumbnail.thumb : 'https://d15dxe0kapai5v.cloudfront.net/articles/69_trip_to_harihareshwar/shrivardhan_01.jpg'
    }
  }
}
</script>

<style lang="scss">
  .gallery-card {
    .gallery-card-image {
      height: 172px;
      overflow: hidden;
      .card-img-top {
        max-width: 100%;
        height: auto;
      }
    }
  }
</style>
