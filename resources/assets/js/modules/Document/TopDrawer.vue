<template>
  <div class="document-drawer__wrapper mb-3">
    <i class="fa fa-arrow-left cursor" v-on:click="handleBack"></i>
    <i class="fa fa-upload cursor pull-right" v-on:click="handleUpload"></i>
  </div>
</template>

<script>
  export default {
    methods: {
      handleBack() {
        this.$store.dispatch('handleFolderBack').then(response => {
          this.$emit('cameBack');
        })
      },
      handleUpload() {
        window.eventBus.$emit('upload_file');
      }
    }
  }
</script>

<style scoped>

</style>
