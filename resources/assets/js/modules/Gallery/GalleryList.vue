<template>
  <div class="galler-list__wrapper" id="gallery-isotope">
    <div class="card" style="width: 18rem;" v-for="(gallery, key) in galleries" v-bind:key="gallery.id">
      <img class="card-img-top" src="https://d15dxe0kapai5v.cloudfront.net/articles/69_trip_to_harihareshwar/shrivardhan_01.jpg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{gallery.name}}</h5>
        <p class="card-text">{{gallery.description}}</p>
        <a v-bind:href="gallery.slug" class="btn btn-primary">View gallery</a>
      </div>
    </div>
  </div>
</template>

<script>
  import Isotope from 'isotope-layout';
  export default {
    props: ['galleries'],

    mounted() {
      var elem = document.getElementById('gallery-isotope');
      var isotope = new Isotope(elem, {
        itemSelector: '.card',
        layoutMode: 'masonry'
      });
    }
  }
</script>

<style lang="scss">
  .galler-list__wrapper .card {
    margin-right: .5rem;
    margin-bottom: .5rem;
  }
</style>
