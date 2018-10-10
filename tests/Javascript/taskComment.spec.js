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
        {'id': 1, 'body': 'This is my first comment', created_at: '2018-10-11 01:16:00'},
        {'id': 2, 'body': 'This is my second comment', created_at: '2018-10-11 01:16:00'}
      ]
    });

    expect(wrapper.find('.list-group-item:first-child').text()).toBe('This is my first comment 10/11/2018 1:16 am');
    expect(wrapper.find('.list-group-item:nth-child(2)').text()).toBe('This is my second comment 10/11/2018 1:16 am');
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
      response: {id: 3, body: 'This is a new comment', created_at: '2018-10-11 01:16:00'}
    });

    moxios.wait(() => {
      expect(wrapper.find('.list-group-item').text()).toBe('This is a new comment 10/11/2018 1:16 am');
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

  it('Shows comment with correct date', () => {
    wrapper.setProps({
      show: true,
    });

    wrapper.setData({
      comments: [{id: 1, body: 'Test', created_at: '2018-10-11 01:16:00'}]
    });

    expect(wrapper.find('span.comment-date').text()).toBe('10/11/2018 1:16 am');
  });

  it('Shows comment with correct date and format', () => {
    wrapper.setProps({
      show: true,
    });

    wrapper.setData({
      comments: [{id: 1, body: 'Test', created_at: '2018-10-11 23:59:00'}]
    });

    expect(wrapper.find('span.comment-date').text()).toBe('10/11/2018 11:59 pm');
  });

  it('Shows invalid date for wrong format', () => {
    wrapper.setProps({
      show: true,
    });

    wrapper.setData({
      comments: [{id: 1, body: 'Test', created_at: '11-30-11 23:59:00'}]
    });

    expect(wrapper.find('span.comment-date').text()).toBe('Invalid date');
  });
});
