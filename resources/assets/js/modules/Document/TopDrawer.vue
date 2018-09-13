<template>
  <div class="document-drawer__wrapper mb-3">
    <i class="fa fa-arrow-left cursor" v-on:click="handleBack"></i>
  </div>
</template>

<script>
  export default {
    methods: {
      handleBack() {
        this.$store.dispatch('handleFolderBack').then(response => {
          this.$emit('cameBack');
        })
      }
    }
  }
</script>

<style scoped>

</style>
