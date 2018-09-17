<template>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" v-for="(crumb, key) in crumbs"><a v-on:click.prevent="handleCrumbClick(key)" href="#">{{crumb}}</a></li>
    </ol>
  </nav>
</template>

<script>
  import _ from 'lodash';
  import {mapState} from 'vuex';
  export default {
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      }),
      crumbs() {
        if (this.documentStore.folders != undefined && this.documentStore.folders != '') {
          return this.documentStore.folders.path.split('/');
        }
        return [];
      }
    },
    methods: {
      handleCrumbClick(crumb) {
        let path = this.documentStore.folders.path;
        let arrApth = path.split('/');
        let url = '';
        for (let i = 0; i <= crumb; i++) {
          url = url + arrApth[i] + '/';
        }
        this.$emit('folderSelected', url.slice(0,-1));
      }
    }
  }
</script>

<style scoped>

</style>
