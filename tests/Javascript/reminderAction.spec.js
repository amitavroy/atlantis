import {mount} from '@vue/test-utils';
import ReminderAction from './../../resources/assets/js/modules/Reminder/ReminderAction.vue';
import expect from 'expect';
import moxios from 'moxios';
import Vue from "vue";

describe('Reminder action component', () => {
  let wrapper;

  beforeEach(() => {
    window.eventBus = new Vue({});
    wrapper = mount(ReminderAction);
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('shows pay button if reminder is bill', () => {
    wrapper.setProps({
      type: 'Bill',
      reminder: {'title': 'This is a title'}
    });

    expect(wrapper.find('.btn').text()).toBe('Pay');
  });

  it('pay now button fires event to open modal', () => {
    wrapper.setProps({
      type: 'Bill',
      reminder: {'title': 'This is a title'}
    });

    window.eventBus.$on('reminderPaymentClick', () => {
      wrapper.vm.$emit('reminderPaymentClickLocal');
    });

    wrapper.find('.btn').trigger('click');

    expect(wrapper.emitted('reminderPaymentClickLocal')).toBeTruthy();
  });
});
