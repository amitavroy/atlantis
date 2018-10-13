/*Event listners globally for the app emitted using window.eventBus*/
window.Echo.private('Tasks').listen('.task.created', data => {
  window.eventBus.$emit('taskCountIncrement', data);
  window.eventBus.$emit('taskCountUpdated', 'increment');
});

window.Echo.private('Tasks').listen('.task.deleted', data => {
  window.eventBus.$emit('taskCountDecrement', data);
  window.eventBus.$emit('taskCountUpdated', 'decrement');
});

window.Echo.private('Dashboard').listen('.site.normal', data => {
  window.eventBus.$emit('siteMonitorDataUpdate', data);
});

window.Echo.private('Dashboard').listen('.site.slow', data => {
  window.eventBus.$emit('siteIsSlow', data);
});

window.Echo.private('Expenses').listen('.expense.created', data => {
  window.eventBus.$emit('expenseAdded', data);
});

window.Echo.private('GitProject').listen('.project.update', data => {
  window.eventBus.$emit('gitProjectUpdate', data);
});
