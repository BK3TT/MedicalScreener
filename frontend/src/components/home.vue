<template>
  <div :id="'theme-' + this.$route.name">
    <h2 class='title'>Welcome to our Medical Service</h2>
    <h5 class='sub-title'>Please fill out our survey to allow us to see if you qualify for a late stage medical drug trial</h5>
    <div class='action-buttons'>
      <a href="/#/survey" class="button">Fill out survey</a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      msg: ''
    }
  }
}
</script>
