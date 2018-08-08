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
  props: ['color', 'text', 'count', 'icon'],
  computed: {
    widgetColor() {
      return (this.color) ? this.color : 'primary';
    },
    widgetText() {
      return (this.text) ? this.text : 'Undefined';
    },
    widgetCount() {
      return (this.count) ? this.count : 0;
    },
    widgetIcon() {
      return (this.icon) ? this.icon : 'fa-users';
    }
  }
}
</script>
