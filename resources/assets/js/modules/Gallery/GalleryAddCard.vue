<template>
  <div class="gallery-add-card__wrapper">
    <div class="tile">
      <div class="tile-body">
        <form action="#" v-on:submit.prevent="handleFormSubmit">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" v-model="gallery.name">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" v-model="gallery.description">
          </div>

          <button class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        gallery: this.setGallery()
      }
    },
    methods: {
      setGallery() {
        return {
          name: '',
          description: '',
          private: true
        }
      },
      handleFormSubmit() {
        axios.post('/api/personal/gallery/add', this.gallery).then(response => {
          this.gallery = this.setGallery();
        });
      }
    }
  }
</script>
