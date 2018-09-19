import {mount} from '@vue/test-utils';
import GalleryView from './../../resources/assets/js/modules/Gallery/GalleryView.vue';
import GalleryImageAdd from './../../resources/assets/js/modules/Gallery/GalleryImageAdd.vue';
import expect from 'expect';

describe('Gallery add component', () => {
  let wrapper;

  it('shows the add image button', () => {
    wrapper = mount(GalleryView);
    expect(wrapper.html()).toContain('Add Images');
  });

  it.only('shows form when button is clicked', () => {
    wrapper = mount(GalleryImageAdd);
    let button = wrapper.find('#add-image');
    button.trigger('click');
    expect(wrapper.html()).toContain('Save images');
  });
});
