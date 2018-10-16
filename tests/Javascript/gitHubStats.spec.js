import {mount} from '@vue/test-utils';
import GitStats from './../../resources/assets/js/modules/GitProject/GitStats.vue';
import expect from 'expect';
import moxios from 'moxios';
import Vue from "vue";

describe('Github stats component', () => {
  let wrapper;

  beforeEach(() => {
    window.eventBus = new Vue({});
    wrapper = mount(GitStats);
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('shows the projects as response from ajax', (done) => {
    wrapper.setData({
      loading: false,
      repos: []
    });

    moxios.stubRequest('/api/git-projects/list', {
      status: 200,
      response: [
        {id: 1}
      ]
    });

    moxios.wait(() => {
      console.log(wrapper.find('.table-bordered').text());
      done();
    });
  });
});
