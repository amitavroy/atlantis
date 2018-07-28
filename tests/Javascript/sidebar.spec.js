import {mount} from '@vue/test-utils';
import SidebarToggle from './../../resources/assets/js/components/SidebarToggle.vue';
import expect from 'expect';

describe('Sidebar toggle component', () => {

  let wrapper, bodyClass;

  beforeEach(() => {
    bodyClass = document.querySelector('body').classList;
    wrapper = mount(SidebarToggle);
  });

  it('adds the class when it is not present', () => {
    let button = wrapper.find('.app-sidebar__toggle');
    button.trigger('click');
    expect(bodyClass[0]).toBe('sidenav-toggled');
  });

  it('removes the class when it is not present', () => {
    bodyClass.add('sidenav-toggled');
    let button = wrapper.find('.app-sidebar__toggle');
    button.trigger('click');
    expect(bodyClass.length).toEqual(0);
  });

});
