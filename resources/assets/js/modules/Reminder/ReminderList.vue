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

    <modal name="expense-add"
      height="auto"
      v-on:opened="handleModalOpen">
      <div class="m-3">
        <expense-add></expense-add>
      </div>
    </modal>
  </div>
</template>

<script>
  import ReminderAction from './ReminderAction.vue';
  import ExpenseAdd from './../Expense/ExpenseAdd.vue';
  export default {
    props: ['events'],
    components: {
      ReminderAction, ExpenseAdd
    },
    created() {
      this.localEvents = JSON.parse(this.events);
      window.eventBus.$on('reminderPaymentClick', () => {
        this.$modal.show('expense-add');
      });
    },
    data() {
      return {
        loading: true,
        localEvents: []
      }
    },
    methods: {
      handleModalOpen() {
        window.eventBus.$emit('toggleAddExpenseForm');
      }
    }
  }
</script>
