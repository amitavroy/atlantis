<template>
  <div class="galler-list__wrapper" id="gallery-isotope">
    <gallery-card v-for="(gallery) in galleries"
      v-bind:key="gallery.id"
      :gallery='gallery'></gallery-card>
  </div>
</template>

<script>
  import Isotope from 'isotope-layout';
  import GalleryCard from './GalleryCard.vue';
  export default {
    components: {
      GalleryCard
    },

    props: ['galleries'],

    mounted() {
      setTimeout(() => {
        var elem = document.getElementById('gallery-isotope');
        var isotope = new Isotope(elem, {
          itemSelector: '.card',
          layoutMode: 'masonry'
        });
      }, 500);
    }
  }
</script>

<style lang="scss">
  .galler-list__wrapper .card {
    margin-right: .5rem;
    margin-bottom: .5rem;
  }
</style>
