import {mount} from '@vue/test-utils';
import GalleryList from './../../resources/assets/js/modules/Gallery/GalleryList.vue';
import expect from 'expect';

describe('Gallery list component', () => {
  let wrapper;

  it('shows name and description of the gallery', () => {
    wrapper = mount(GalleryList, {
      propsData: {
        galleries: [
          {description: 'This is my first gallery.', name: 'First gallery', id:  1, slug: 'http://demo.com'},
          {description: 'This is my second gallery.', name: 'Second gallery', id:  2}
        ]
      }
    });

    expect(wrapper.html()).toContain('<h5 class="card-title">First gallery</h5>');
    expect(wrapper.html()).toContain('<p class="card-text">This is my first gallery.</p>');
    expect(wrapper.html()).toContain('<a href="http://demo.com" class="btn btn-primary">View gallery</a>');

    expect(wrapper.html()).toContain('<h5 class="card-title">Second gallery</h5>');
    expect(wrapper.html()).toContain('<p class="card-text">This is my second gallery.</p>');
  });

  it('gallery generates the correct link', () => {
    wrapper = mount(GalleryList, {
      propsData: {
        galleries: [
          {description: 'This is my first gallery.', name: 'First gallery', id:  1, slug: 'http://demo.com'}
        ]
      }
    });

    expect(wrapper.html()).toContain('<a href="http://demo.com" class="btn btn-primary">View gallery</a>');
  });
});
