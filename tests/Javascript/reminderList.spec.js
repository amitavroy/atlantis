import {mount} from '@vue/test-utils';
import ReminderList from './../../resources/assets/js/modules/Reminder/ReminderList.vue';
import expect from 'expect';
import moxios from 'moxios';

describe('Reminder list component', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(ReminderList);
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });
});
