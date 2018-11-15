<template>
  <div class="document-group__wrapper">
    <top-drawer></top-drawer>
    <document-breadcrumb
      v-on:folderSelected="handleFolderSelected"></document-breadcrumb>
    <ul class="list-group" v-if="!loading">
      <document-folder
        v-on:folderSelected="handleFolderSelected"
        v-for="folder in documentStore.folders.directories"
        :folder="folder" :key="folder.id"></document-folder>

      <document-file
        v-for="file in documentStore.folders.files"
        :file="file" :key="file.id"></document-file>
    </ul>
    <div v-if="loading">Loading...</div>
    <modal name="file-upload"
           height="auto"
           v-on:opened="handleModalOpen">
      <div class="m-3">
        <document-upload></document-upload>
      </div>
    </modal>
  </div>
</template>

<script>
  import {mapState} from 'vuex';
  import TopDrawer from './TopDrawer.vue';
  import DocumentFolder from './DocumentFolder.vue';
  import DocumentFile from './DocumentFile.vue';
  import DocumentBreadcrumb from './DocumentBreadcrumb.vue';
  import DocumentUpload from './DocumentUpload.vue';
  import LocalDB from './../../utils/LocalDB';

  export default {
    components: {
      DocumentFolder, TopDrawer, DocumentFile, DocumentBreadcrumb, DocumentUpload
    },
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      })
    },
    created() {
      let path = '';
      path = (LocalDB.getData('lastPath')) ? LocalDB.getData('lastPath') : '';

      this.$store.dispatch('getFolderStructure', path).then(response => {
        this.loading = false
      });

      window.eventBus.$on('directory_loading', () => this.loading = true);
      window.eventBus.$on('directory_loaded', () => this.loading = false);
      window.eventBus.$on('upload_file', () => this.$modal.show('file-upload'));
    },
    data() {
      return {
        loading: true
      }
    },
    methods: {
      handleFolderSelected(folderPath) {
        this.loading = true
        this.$store.dispatch('getFolderStructure', folderPath).then(response => {
          this.loading = false
        });
      },
      handleModalOpen() {
      }
    }
  }
</script>

<style scoped>

</style>
