<template>
  <div :id="'theme-' + this.$route.name">
    <h2 class='title'>Survey Completed</h2>
    <h5 class='sub-title'>Unfortunately, you did not qualify for the drug trail.</h5>
  </div>
</template>

<script>
export default {
  name: 'completion',
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>
