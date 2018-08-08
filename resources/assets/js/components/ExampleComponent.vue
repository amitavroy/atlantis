<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            I'm an example component.
            <button @click="handleClick">Click me</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        count: 0
      }
    },
    methods: {
      handleClick() {
        this.count++;
        window.eventBus.$emit('taskCountUpdated', this.count);
      }
    }
  }
</script>
