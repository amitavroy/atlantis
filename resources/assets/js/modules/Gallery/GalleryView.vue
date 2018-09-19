<template>
  <div class="gallery-view__wrapper clearfix">
    <gallery-image-add :gallery-id="galleryId"
       v-on:imagesAdded="handleImagesAdded"
       :images="localImages"></gallery-image-add>

    <section class="photos" id="photos">
      <a v-bind:href="image.signed.src" v-for="image in localImages" :key="image.id" target="_blank">
        <img v-bind:src="image.signed.thumb" class="photo">
      </a>
    </section>
  </div>
</template>

<script>
  import _ from 'lodash';
  import GalleryImageAdd from './GalleryImageAdd.vue';
  export default {
    props: ['images', 'galleryId'],
    components: {GalleryImageAdd},
    created() {
      this.localImages = this.images;
    },
    data() {
      return {
        localImages: []
      }
    },
    methods: {
      handleImagesAdded(images) {
        _.forEach(images, image => {
          this.localImages.unshift(image);
        });
      }
    }
  }
</script>

<style lang="scss">
  .photos {
    .photo {
      height: 160px;
    }
  }
</style>
