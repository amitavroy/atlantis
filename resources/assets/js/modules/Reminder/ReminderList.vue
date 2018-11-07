<template>
  <div class="tile">
    <div class="tile-title-w-btn">
      <h3 class="title"><i class="fa fa-bell"></i> Reminders</h3>
      <span class="pull-right">
        <a href="/personal/reminders"><i class="fa fa-chevron-right"></i></a>
      </span>
    </div>
    <div class="tile-body">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Description</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="event in localEvents">
          <td>{{event.data.reminder.title}}</td>
          <td>{{event.data.reminder.reminder_date}}</td>
          <td>
            <reminder-action :type="event.data.reminder.type"></reminder-action>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import ReminderAction from './ReminderAction.vue';
  export default {
    props: ['events'],
    components: {
      ReminderAction
    },
    created() {
      this.localEvents = JSON.parse(this.events);
    },
    data() {
      return {
        loading: true,
        localEvents: []
      }
    }
  }
</script>
