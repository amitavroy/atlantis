import Vue from 'vue';
import {mount} from '@vue/test-utils';
import IconWidget from './../../resources/assets/js/components/IconWidget.vue';
import expect from 'expect';

describe('Icon widget component', () => {
  let wrapper;

  beforeEach(() => {
    window.eventBus = new Vue({});
  });

  it('adds the color based on props', () => {
    wrapper = mount(IconWidget, {
      propsData: {
        color: 'primary',
        text: 'Testing',
        count: 45,
        icon: 'fa-users'
      }
    });

    expect(wrapper.html()).toContain('class="widget-small coloured-icon primary"');
    expect(wrapper.html()).toContain('<h4>Testing</h4>');
    expect(wrapper.html()).toContain('<p><b>45</b></p>');
    expect(wrapper.html()).toContain('<i class="icon fa fa-3x fa-users"></i>');
  });

  it('adds the color based on props', () => {
    wrapper = mount(IconWidget, {
      propsData: {
        color: 'primary',
        text: 'Testing',
        count: 45,
        icon: 'fa-users'
      }
    });

    expect(wrapper.html()).toContain('class="widget-small coloured-icon primary"');
    expect(wrapper.html()).toContain('<h4>Testing</h4>');
    expect(wrapper.html()).toContain('<p><b>45</b></p>');
    expect(wrapper.html()).toContain('<i class="icon fa fa-3x fa-users"></i>');
  });

  it('event is raised value is visible', () => {
    wrapper = mount(IconWidget, {
      propsData: {
        color: 'primary',
        text: 'Testing',
        count: 45,
        icon: 'fa-users',
        eventName: 'taskCountUpdated'
      }
    });

    expect(wrapper.html()).toContain('<p><b>45</b></p>');

    window.eventBus.$emit('taskCountUpdated', 4);

    expect(wrapper.html()).toContain('<p><b>4</b></p>');
  });
});
