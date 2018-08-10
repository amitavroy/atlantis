<template>
  <div class="task-group__wrapper">
    <div class="tile">
      <div class="overlay" v-if="loading">
        <div class="m-loader mr-4">
          <svg class="m-circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
          </svg>
        </div>
        <h3 class="l-text">Loading</h3>
      </div>
      <div class="tile-title-w-btn">
        <h3 class="title">All Tasks ({{tasks.length}})</h3>
        <p>
          <a class="btn btn-primary icon-btn" v-bind:href="url">
            <i class="fa fa-plus"></i>Add Task
          </a>
        </p>
      </div>

      <div class="tile-body">
        <ul class="list-group list-group-flush" v-if="!loading">
          <task-item
            v-for="task in localTasks"
            :description="task.description"
            :id="task.id"
            :key="task.id"
          ></task-item>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  import TaskItem from './TaskItem';

  export default {
    props: ['tasks', 'url'],

    components: {
      TaskItem
    },

    created() {
      window.Echo.channel('tasks').listen('.task.created', data => {
        this.localTasks.unshift(data.task);
      });

      setTimeout(() => {
        this.localTasks = this.tasks;
        this.loading = false;
      }, 700)
    },

    data() {
      return {
        loading: true,
        localTasks: []
      }
    }
  }
</script>
