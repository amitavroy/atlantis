import Vue from 'vue';
import {mount} from '@vue/test-utils';
import ReminderList from './../../resources/assets/js/modules/Reminder/ReminderList.vue';
import expect from 'expect';

describe('Reminder list component', () => {
  let wrapper;

  beforeEach(() => {
    // window.eventBus = new Vue({});
    // wrapper = mount(ReminderList);
  });

  it.only('shows reminder list when reminder events are passed', () => {
    // wrapper.setProps({
    //   events: [{
    //     data: {
    //       reminder: {
    //         title: 'This is event 1',
    //         reminder_date: '7th Nov',
    //         type: 'Bill'
    //       }
    //     }
    //   }, {
    //     data: {
    //       reminder: {
    //         title: 'This is event 2',
    //         reminder_date: '7th Nov',
    //         type: 'Bill'
    //       }
    //     }
    //   }]
    // });

    // expect(wrapper.html()).toContain('This is event 1');
    // expect(wrapper.html()).toContain('This is event 2');
  });
});
