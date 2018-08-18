import Vue from 'vue';
import {mount} from '@vue/test-utils';
import ExpenseList from './../../resources/assets/js/modules/Expense/ExpenseList.vue';
import expect from 'expect';

describe('Expense list', () => {
  let wrapper;

  beforeEach(() => {
    window.eventBus = new Vue({});
  });

  it('shows items expenses are present', () => {
    wrapper = mount(ExpenseList, {
      propsData: {
        expenses: [
          {description: 'Some description', category: 'Category', payment_method: 'Cash', user: {name: 'Jhon'}, expense_amt: 420},
          {description: 'One more', category: 'Category', payment_method: 'Cash', user: {name: 'Jhon'}, expense_amt: 500}
        ]
      }
    });

    expect(wrapper.html()).toContain('<td class="description">Some description</td>');
    expect(wrapper.html()).toContain('<td class="description">One more</td>');
  });

  it('shows message when no expenses are present', () => {
    wrapper = mount(ExpenseList, {
      propsData: {
        expenses: []
      }
    });

    expect(wrapper.html()).toContain('No expenses added yet.');
  });
});
