/*Event listners globally for the app emitted using window.eventBus*/
window.Echo.private('Tasks').listen('.task.created', data => {
  window.eventBus.$emit('taskCountIncrement', data);
  window.eventBus.$emit('taskCountUpdated', 'increment');
});

window.Echo.private('Tasks').listen('.task.deleted', data => {
  window.eventBus.$emit('taskCountDecrement', data);
  window.eventBus.$emit('taskCountUpdated', 'decrement');
});
