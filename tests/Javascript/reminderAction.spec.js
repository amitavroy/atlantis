import {mount} from '@vue/test-utils';
import ReminderAction from './../../resources/assets/js/modules/Reminder/ReminderAction.vue';
import expect from 'expect';
import moxios from 'moxios';

describe('Reminder action component', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(ReminderAction);
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('shows pay button if reminder is bill', () => {
    wrapper.setProps({
      type: 'Bill'
    });

    expect(wrapper.find('.btn').text()).toBe('Pay');
  });
});
