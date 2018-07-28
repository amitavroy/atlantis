import {mount} from '@vue/test-utils';
import TaskItem from './../../resources/assets/js/modules/Task/TaskItem.vue';
import expect from 'expect';

describe('Task item', () => {

  let wrapper;

  beforeEach(() => {
    wrapper = mount(TaskItem);
  });

  it('Shows the task description', () => {
    wrapper.setProps({
      description: 'This is my task'
    });

    expect(wrapper.find('.description').text()).toBe('This is my task');
  });

  it('Shows the done button on mouse over', () => {
    wrapper.trigger('mouseover');

    expect(wrapper.find('.done').text()).toBe('Done');
  });

  

});
