<template>
  <div class="widget-small coloured-icon" v-bind:class="widgetColor">
    <i class="icon fa fa-3x" v-bind:class="widgetIcon"></i>
    <div class="info">
      <h4 v-text="widgetText"></h4>
        <p><b v-text="widgetCount"></b></p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['color', 'text', 'count', 'icon', 'eventName'],
  created() {
    (this.count) ? this.widgetCount = this.count : this.widgetCount = 0;

    if (this.eventName) {
      window.eventBus.$on(this.eventName, event => this.handleTaskCountUpdated(event));
    }
  },
  data() {
    return {
      widgetCount: null
    }
  },
  computed: {
    widgetColor() {
      return (this.color) ? this.color : 'primary';
    },
    widgetText() {
      return (this.text) ? this.text : 'Undefined';
    },
    widgetIcon() {
      return (this.icon) ? this.icon : 'fa-users';
    }
  },
  methods: {
    handleTaskCountUpdated(condition) {
      switch (condition) {
        case 'increment':
        this.widgetCount++;
        break;

        case 'decrement':
        this.widgetCount--;
        break;

        default:
        return false;
      }
    }
  }
}
</script>
