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
});
