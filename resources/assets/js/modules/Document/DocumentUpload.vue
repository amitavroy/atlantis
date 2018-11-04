<template>
  <div class="document-upload__wrapper" v-show="show">
    <div class="m-5 p-5 border rounded-lg shadow">
      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="handleFileUpload">
        <input type="file" name="file" class="flex">
        <button class="bg-red rounded text-white px-3 py-2 mt-3">Upload</button>
      </form>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        show: true
      }
    },
    created() {
      window.eventBus.$on('uploadFile', this.handleFileUpload);
    },
    methods: {
      handleFileUpload(file) {
        console.log('file', file);
        this.show = true;
      }
    }
  }
</script>
