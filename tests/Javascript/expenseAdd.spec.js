import Vue from 'vue';
import {mount} from '@vue/test-utils';
import ExpenseAdd from './../../resources/assets/js/modules/Expense/ExpenseAdd.vue';
import expect from 'expect';
import moment from 'moment';

describe('Expense add form', () => {
  let wrapper;

  beforeEach(() => {
    window.eventBus = new Vue({});
    wrapper = mount(ExpenseAdd);
  });

  it('show the form when show form event is triggered', () => {
    window.eventBus.$emit('toggleAddExpenseForm');
    expect(wrapper.html()).toContain('Add new expense');
  });

  it('shows description when pay button is clicked', () => {
    const description = 'Payment of something.';

    let expense = {
      "description": description,
      "reminder_id": 1
    }

    window.eventBus.$emit('toggleAddExpenseForm', expense);

    expect(wrapper.vm.$data.expense.description).toBe(description);
  });
});
