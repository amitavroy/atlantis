<template>
  <div class="gallery-view__wrapper clearfix">
    <section class="photos" id="photos">
      <a v-bind:href="image.signed.src" v-for="image in images" :key="image.id" target="_blank">
        <img v-bind:src="image.signed.thumb" class="photo">
      </a>
    </section>
  </div>
</template>

<script>
  export default {
    props: ['images']
  }
</script>

<style lang="scss">
  .photos {
    .photo {
      height: 160px;
    }
  }
</style>
