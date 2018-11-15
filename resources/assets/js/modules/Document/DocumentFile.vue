<template>
  <li class="list-group-item cursor">
    <span class="pull-left">
      <i class="fa fa-file mr-2"></i> {{fileName}}
    </span>
    <span class="pull-right">
      <i class="fa fa-download mr-3" v-on:click="fileSelected"></i>
      <i class="fa fa-upload mr-3" v-on:click="fileUpload"></i>
      <i class="fa fa-trash mr-3" v-on:click="fileDelete"></i>
    </span>
  </li>
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
      },
      fileUpload() {
        window.eventBus.$emit('uploadFile', this.file);
      },
      fileDelete() {
        let conf = confirm(`Are you sure you want to delete ${this.file}`);

        if (!conf) {
          return false;
        }

        let postData = {
          currentPath: this.documentStore.folders.path,
          filePath: this.file
        }

        this.$store.dispatch('handleFileDelete', postData)
          .then(response => {
          })
          .catch(error => console.error(error));
      }
    }
  }
</script>

<style scoped>

</style>
