<template>
  <div class="reminder-action__wrapper">
      <button class="btn btn-sm btn-success" v-if="type == 'Bill'">Pay</button>
  </div>
</template>

<script>
export default {
  props: ['type']
}
</script>
