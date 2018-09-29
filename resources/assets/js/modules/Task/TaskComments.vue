<template>
  <div v-if="show" class="mt-3 task-comment__wrapper">
    <form v-on:submit.prevent="handleSubmit" class="add-comment-form">
      <input type="text" class="form-control" placeholder="Enter comment" v-model="commentText">
    </form>
    <ul class="list-group">
      <li class="list-group-item" v-for="comment in comments" :key="comment.id">
        <i class="fa fa-arrow-right"></i> {{comment.body}}
      </li>
    </ul>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    props: ['show', 'taskId', 'parentComments'],

    data() {
      return {
        commentText: '',
        comments: []
      }
    },

    created() {
      this.comments = this.parentComments;
    },

    methods: {
      handleSubmit() {
        let postData = {'comment': this.commentText, 'task_id': this.taskId};

        axios.post('/api/tasks/comment', postData).then(({data}) => {
          this.comments.unshift(data);
          this.commentText = '';
        });
      }
    }
  }
</script>
