<template>
  <li class="list-group-item description"
      @mouseover="handleMouseOver" @mouseout="handleMouseOut">
    {{description}}
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
  </li>
</template>

<script>
  export default {
    props: ['description', 'id'],

    data () {
      return {
        displayExtras: false
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
      }
    }
  }
</script>

<style scoped>

</style>
