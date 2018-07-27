<template>
  <li class="list-group-item description"
      @mouseover="handleMouseOver" @mouseout="handleMouseOut">
    {{description}}
    <span class="float-right done" v-if="displayExtras">
      Done
    </span>
  </li>
</template>

<script>
  export default {
    props: ['description'],

    data () {
      return {
        displayExtras: false
      }
    },

    methods: {
      handleMouseOver () {
        this.displayExtras = true;
      },
      handleMouseOut () {
        this.displayExtras = false;
      }
    }
  }
</script>

<style scoped>

</style>
