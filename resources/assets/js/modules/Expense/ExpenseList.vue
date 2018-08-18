<template>
  <div class="expense-list__wrapper">
    <table class="table">
      <thead>
        <tr>
          <th>Description</th>
          <th>Category</th>
          <th>Date</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="expense in localExpenses" v-bind:key="expense.id">
          <td>{{expense.description}}</td>
          <td>
            {{expense.category}}
            <br>
            <small class="text-muted">{{expense.payment_method}}</small>
          </td>
          <td>
            {{expense.transaction_date}}
            <br>
            <small class="text-muted">{{expense.user.name}}</small>
          </td>
          <td>
            <span class="text-muted">Rs</span>
            {{expense.expense_amt}}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ['expenses'],
  created() {
    this.localExpenses = this.expenses;
    window.eventBus.$on('expenseAdded', data => {
      this.localExpenses.unshift(data.expense);
    });
  },
  data() {
    return {
      localExpenses: []
    }
  }
}
</script>
