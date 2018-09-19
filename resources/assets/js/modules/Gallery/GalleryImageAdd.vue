<template>
  <div class="mb-3">
    <button class="btn btn-success mb-2" v-on:click="handleButtonClick" id="add-image">Add Images</button>
    <form v-on:submit.prevent="handleFormSubmit" v-if="showAddForm">
        <textarea name="images"
            id="images"
            class="form-control mb-2"
            v-model="imageText" rows="5"></textarea>
      <button class="btn btn-success">Save images</button>
    </form>
  </div>
</template>

<script>
  import axios from 'axios';
  export default {
    props: ['images', 'galleryId'],
    data() {
      return {
        showAddForm: false,
        imageText: ''
      }
    },
    methods: {
      handleButtonClick() {
        this.showAddForm = !this.showAddForm;
      },
      handleFormSubmit() {
        let postData = {
          galleryId: this.galleryId,
          text: this.imageText
        }

        axios.post('/api/personal/gallery/image-add', postData).then(response => {
          this.$emit('imagesAdded', response.data);
          this.imageText = '';
        });
      }
    }
  }
</script>
