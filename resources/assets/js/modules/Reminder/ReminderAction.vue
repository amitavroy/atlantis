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
  props: ['type'],
  methods: {
    handleBillPayClick() {
      window.eventBus.$emit('reminderPaymentClick');
      // window.eventBus.$emit('toggleAddExpenseForm');
    }
  }
}
</script>
