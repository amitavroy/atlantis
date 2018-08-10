/*Event listners globally for the app emitted using window.eventBus*/
window.Echo.channel('tasks').listen('.task.created', data => {
  window.eventBus.$emit('taskCountUpdated', data);
});
