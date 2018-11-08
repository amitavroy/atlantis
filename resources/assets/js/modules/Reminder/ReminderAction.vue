<template>
  <div class="reminder-action__wrapper">
    <div class="bill__wrapper">
      <button
        class="btn btn-sm btn-success"
        v-on:click="handleBillPayClick"
        v-if="type == 'Bill'">
        Pay
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['type', 'reminder'],
  methods: {
    handleBillPayClick() {
      let expense = {
        "description": "Payment of " + this.reminder.title + " due " + this.reminder.reminder_date,
        "reminder_id": this.reminder.id
      }
      window.eventBus.$emit('reminderPaymentClick', expense);
    }
  }
}
</script>
