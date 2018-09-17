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
  </div>
</template>

<script>
  import {mapState} from 'vuex';
  import TopDrawer from './TopDrawer.vue';
  import DocumentFolder from './DocumentFolder.vue';
  import DocumentFile from './DocumentFile.vue';
  import DocumentBreadcrumb from './DocumentBreadcrumb.vue';

  export default {
    components: {
      DocumentFolder, TopDrawer, DocumentFile, DocumentBreadcrumb
    },
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      })
    },
    created() {
      this.$store.dispatch('getFolderStructure', '').then(response => {
        this.loading = false
      });

      window.eventBus.$on('directory_loading', () => this.loading = true);
      window.eventBus.$on('directory_loaded', () => this.loading = false);
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
      }
    }
  }
</script>

<style scoped>

</style>
