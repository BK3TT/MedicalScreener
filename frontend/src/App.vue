<template>
  <div id="app" class="bg-secondary">
    <div class="header">
      <a href="/#/" class="logo">
        <img src="./assets/images/blinx-logo.png" alt="logo">
      </a>
      <div class="account-buttons" v-show="this.$route.name != 'signin' && this.$route.name != 'register'">
        <template v-if="!this.$session.id() && !this.$session.get('id')">
          <a href="/#/signin">Sign in <font-awesome-icon icon="arrow-right" /></a>
        </template>
        <template v-else>
          <template v-if="this.$session.id() && this.$session.get('id') && this.$route.name != 'user'">
            <a href="/#/user"> {{ this.$session.get('forename') }} <font-awesome-icon icon="user" /></a>
          </template>
          <template v-else>
            <a href="/#/user" v-on:click="logout"><font-awesome-icon icon="arrow-left" /> Sign out</a>
          </template>
        </template>
      </div>
    </div>
    <router-view/>
  </div>
</template>
<script>
export default {
  name: 'App',
  methods: {
    logout: function (e) {
      e.preventDefault()
      this.$session.destroy()
      this.$router.push('/')
    }
  }
}
</script>
