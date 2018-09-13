<template>
  <li class="list-group-item cursor" v-on:click="fileSelected"><i class="fa fa-file mr-2"></i> {{fileName}}</li>
</template>

<script>
  import {mapState} from 'vuex';
  import axios from 'axios';
  export default {
    props: ['file'],
    computed: {
      ...mapState({
        documentStore: state => state.DocumentStore
      }),
      fileName() {
        return this.file.replace(this.documentStore.folders.path + '/', '');
      }
    },
    methods: {
      fileSelected() {
        axios({
          url: '/api/document/download?path=' + this.file,
          method: 'GET',
          responseType: 'blob'
        }).then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', this.file); //or any other extension
          document.body.appendChild(link);
          link.click();
        });
      }
    }
  }
</script>

<style scoped>

</style>
