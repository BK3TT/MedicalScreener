<template>
    <div :id="'theme-' + this.$route.name" class="container">
        <div class="card">
            <article class="card-body">
                <a href="/#/register" class="float-right btn btn-outline-primary">Sign up</a>
                <h4 class="card-title mb-4 mt-1">Sign in</h4>
                <form id="form-signin" @submit="signin">
                    <div class="form-group">
                        <label>Your email</label>
                        <input name="email" class="form-control" placeholder="Email" type="email">
                    </div>
                    <div class="form-group">
                        <a class="float-right" href="#">Forgot?</a>
                        <label>Your password</label>
                        <input name="password" class="form-control" placeholder="******" type="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login <font-awesome-icon icon="arrow-right" /></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</template>
<script>
export default {
  name: 'signin',
  data () {
    return {
      msg: ''
    }
  },
  methods: {
    signin: function (e) {
      e.preventDefault()
      let that = this
      this.$http({
        method: 'post',
        url: 'http://localhost/api/user/login',
        data: window.$('#form-signin').serialize(),
        config: {
          headers: { 'Content-Type': 'multipart/form-data' }
        }
      })
        .then(function (response) {
          if (response.status === 200) {
            that.$session.start()
            for (var key in response.data) {
              that.$session.set(key, response.data[key])
              that.$router.push('/')
            }
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>
