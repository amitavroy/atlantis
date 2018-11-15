<template>
  <div class="document-upload__wrapper" v-show="show">
    <div class="m-5 p-5 border rounded-lg shadow">
      <input type="file" name="file" class="flex" ref="file" v-on:change="handleFileUpload">
      <button class="bg-red rounded text-white px-3 py-2 mt-3">Upload</button>
    </div>
  </div>
</template>

<script>
  import {mapState} from 'vuex';

  export default {
    data() {
      return {
        show: true,
        file: ''
      }
    },
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      })
    },
    created() {
      window.eventBus.$on('uploadFile', this.handleFileUpload);
    },
    methods: {
      handleFileUpload(file) {
        this.file = this.$refs.file.files[0];
        this.show = true;
        let formData = new FormData();
        formData.append('file', this.file);
        formData.append('currentPath', this.documentStore.folders.path);
        window.axios.post('/upload', formData, {
          headers: {'Content-Type': 'multipart/form-data'}
        }).then(response => this.$store.dispatch('getFolderStructure', this.documentStore.folders.path))
          .catch(error => error);
      }
    }
  }
</script>
