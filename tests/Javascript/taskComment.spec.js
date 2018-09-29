import {mount} from '@vue/test-utils';
import TaskComment from './../../resources/assets/js/modules/Task/TaskComments.vue';
import expect from 'expect';
import moxios from 'moxios';

describe('Task comments', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = mount(TaskComment);
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('Shows comments when comment box is open', () => {
    wrapper.setProps({
      show: true
    });

    wrapper.setData({
      comments: [
        {'id': 1, 'body': 'This is my first comment'},
        {'id': 2, 'body': 'This is my second comment'}
      ]
    });

    expect(wrapper.find('.list-group-item:first-child').text()).toBe('This is my first comment');
    expect(wrapper.find('.list-group-item:nth-child(2)').text()).toBe('This is my second comment');
  });

  it('Shows new comment when comment is added', (done) => {
    wrapper.setProps({
      show: true
    });

    wrapper.setData({
      comments: [],
      commentText: 'This is a new comment'
    });

    wrapper.find('.add-comment-form').trigger('submit');

    moxios.stubRequest('/api/tasks/comment', {
      status: 200,
      response: {id: 3, body: 'This is a new comment'}
    });

    moxios.wait(() => {
      expect(wrapper.find('.list-group-item').text()).toBe('This is a new comment');
      expect(wrapper.vm.$data.commentText).toBe('');
      done();
    });

  });

  it('Comment is cleared when new comment is saved post success', (done) => {
    wrapper.setProps({
      show: true
    });

    wrapper.setData({
      comments: [],
      commentText: 'This is a new comment'
    });

    wrapper.find('.add-comment-form').trigger('submit');

    moxios.stubRequest('/api/tasks/comment', {
      status: 200,
      response: {id: 3, comment: 'This is a new comment'}
    });

    moxios.wait(() => {
      expect(wrapper.vm.$data.commentText).toBe('');
      done();
    });

  });
});
