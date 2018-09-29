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
    <task-comments :show="showModal"></task-comments>
  </li>
</template>

<script>
  import VueConfirm from 'vuejs-confirm-directive';
  import TaskComments from './TaskComments.vue';

  export default {
    props: ['description', 'id'],

    components: {
      TaskComments
    },

    data() {
      return {
        displayExtras: false,
        showModal: false
      }
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
      }
    }
  }
</script>
