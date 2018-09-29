<template>
  <div v-if="show" class="mt-3 task-comment__wrapper">
    <form v-on:submit.prevent="handleSubmit" class="add-comment-form">
      <input type="text" class="form-control" placeholder="Enter comment" v-model="commentText">
    </form>
    <ul class="list-group">
      <li class="list-group-item" v-for="comment in comments" :key="comment.id">
        <i class="fa fa-arrow-right"></i> {{comment.comment}}
      </li>
    </ul>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    props: ['show'],

    data() {
      return {
        commentText: '',
        comments: []
      }
    },

    created() {
      this.comments.push({
        "id": 1,
        "comment": "This is some comment"
      });
      this.comments.push({
        "id": 2,
        "comment": "This is one more comment"
      });
    },

    methods: {
      handleSubmit() {
        let postData = {'comment': this.commentText};
        axios.post('/api/tasks/comment', postData).then(({data}) => {
          this.comments.unshift(data);
          this.commentText = '';
        });
      }
    }
  }
</script>
