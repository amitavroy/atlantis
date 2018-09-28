<template>
  <li class="list-group-item description cursor"
      @mouseover="handleMouseOver"
      @mouseout="handleMouseOut">
    <i class="fa fa-plus mr-2" @click="handleTaskClick"></i> {{description}}
    <span class="float-right done cursor"
      v-if="displayExtras"
      v-confirm.reload="{
        link: '/api/tasks/delete',
        message: 'Are you sure you want to delete this task?',
        data: {'task_id': id},
        callback: handleDelete
      }">
      Done
    </span>
    <div v-if="showModal" class="mt-3">
      <form v-on:submit.prevent="handleSubmit">
        <input type="text" class="form-control" placeholder="Enter comment" v-model="commentText">
      </form>
      <ul class="list-group">
        <li class="list-group-item" v-for="comment in comments" :key="comment.id">
          <i class="fa fa-arrow-right"></i> {{comment.comment}}
        </li>
      </ul>
    </div>
  </li>
</template>

<script>
  import VueConfirm from 'vuejs-confirm-directive';

  export default {
    props: ['description', 'id'],

    data() {
      return {
        displayExtras: false,
        showModal: false,
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
      handleMouseOver() {
        this.displayExtras = true;
      },
      handleMouseOut() {
        this.displayExtras = false;
      },
      handleDelete(response) {
        if (response.status === 200) {
          window.eventBus.$emit('eventTaskDeleted', this.id);
        }
      },
      handleTaskClick() {
        this.showModal = !this.showModal;
      },
      handleSubmit() {
        this.comments.unshift({
          "id": this.comments.length + 1,
          "comment": this.commentText
        });
        this.commentText = '';
      }
    }
  }
</script>
