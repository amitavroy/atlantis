<template>
  <div class="expense-add__wrapper">
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
  import vSelect from 'vue-select';
  export default {
    components: {
      'v-select': vSelect
    },
    data() {
      return {
        expense: this.setEmptyDescription(),
        options: [],
        transType: ['Cash', 'Credit Card', 'Net Banking']
      }
    },
    created() {
      axios.get('/api/expenses/categories').then(response => {
        this.options = _.map(response.data, 'name');
      });
    },
    methods: {
      setEmptyDescription() {
        return {
          description: '',
          transaction_date: '',
          amount: '',
          type: '',
          category: ''
        }
      },
      handleFormSubmit() {
        console.log(this.expense);
        axios.post('/api/expenses', this.expense).then(response => {
          // this.expense = this.setEmptyDescription();
          console.log(response.data);
        });
      }
    }
  }
</script>
