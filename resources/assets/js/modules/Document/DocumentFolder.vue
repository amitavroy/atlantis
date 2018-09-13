<template>
  <li class="list-group-item cursor" v-on:click="folderSelected"><i class="fa fa-folder mr-2"></i> {{directoryName}}</li>
</template>

<script>
  import {mapState} from 'vuex';
  export default {
    props: ['folder'],
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      }),
      directoryName() {
        return this.folder.replace(this.documentStore.folders.path + '/', '');
      }
    },
    methods: {
      folderSelected() {
        this.$emit('folderSelected', this.folder);
      }
    }
  }
</script>

<style scoped>

</style>
