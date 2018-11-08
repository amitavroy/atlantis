<template>
  <div class="expense-add__wrapper" v-if="show">
    <h3>Add new expense</h3>
    <form v-on:submit.prevent="handleFormSubmit">
      <div class="form-group">
        <label for="desciption">Description</label>
        <input type="text" name="desciption" id="desciption" class="form-control" v-model="expense.description">
      </div>

      <div class="form-group">
        <label>Category</label>
        <v-select :options="options" v-model="expense.category"></v-select>
      </div>

      <div class="form-group">
        <label>Transaction type</label>
        <v-select :options="transType" v-model="expense.type"></v-select>
      </div>

      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" v-model="expense.transaction_date">
      </div>

      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" name="amount" id="amount" class="form-control" v-model="expense.amount">
      </div>

      <button class="btn btn-success mb-3"><i class="fa fa-save"></i> Save</button>
    </form>
  </div>
</template>

<script>
  import _ from 'lodash';
  import moment from 'moment';
  import vSelect from 'vue-select';
  import axios from 'axios';
  export default {
    components: {
      'v-select': vSelect
    },
    data() {
      return {
        show: false,
        expense: this.setEmptyDescription(),
        options: [],
        transType: ['Cash', 'Credit Card', 'Net Banking']
      }
    },
    created() {
      window.eventBus.$on('toggleAddExpenseForm', (expenseData) => {
        this.show = !this.show;
        if (expenseData != null) {
          this.expense.description = expenseData.description;
          this.expense.category = 'Bills';
          this.expense.reminder_id = expenseData.reminder_id;
        }
      });

      axios.get('/api/expenses/categories').then(response => {
        this.options = _.map(response.data, 'name');
      });
    },
    methods: {
      setEmptyDescription() {
        return {
          description: '',
          transaction_date: moment().format('YYYY-MM-DD'),
          amount: '',
          type: '',
          category: ''
        }
      },
      handleFormSubmit() {
        axios.post('/api/expenses', this.expense).then(response => {
          this.expense = this.setEmptyDescription();
          window.eventBus.$emit('expenseSaved', response.data);
        });
      }
    }
  }
</script>
