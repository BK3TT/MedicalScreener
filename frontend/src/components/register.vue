<template>
    <div :id="'theme-' + this.$route.name" class="container">
        <div class="card">
            <article class="card-body">
                <a href="/#/signin" class="float-right btn btn-outline-primary">Sign in</a>
                <h4 class="card-title mb-4 mt-1">Sign Up</h4>
                <form id="form_register" enctype="multipart/form-data" action="http://localhost/api/user/register" method="POST" @submit="validateRegister">
                    <div class='errors'>
                        <p v-if="errors.length">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </p>
                    </div>
                    <div class="form-group">
                        <label>Your forename</label>
                        <input name="forename" class="form-control" placeholder="Forename" type="text" v-model="forename">
                    </div>
                    <div class="form-group">
                        <label>Your surname</label>
                        <input name="surname" class="form-control" placeholder="Surname" type="text" v-model="surname">
                    </div>
                    <div class="form-group">
                        <label>Your email</label>
                        <input name="email" class="form-control" placeholder="Email" type="email" v-model="email">
                    </div>
                    <div class="form-group">
                        <label>Your password</label>
                        <input name="password" class="form-control" placeholder="******" type="password" v-model="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit <font-awesome-icon icon="arrow-right" /></button>
                    </div>
                    <input :value="pageOrigin" name="redirect" type="hidden">
                </form>
            </article>
        </div>
    </div>
</template>

<script>
export default {
  name: 'register',
  data () {
    return {
      errors: [],
      forename: '',
      surname: '',
      email: '',
      password: '',
      pageOrigin: window.location.origin + '/#/signin'
    }
  },
  methods: {
    validateRegister: function (e) {
      this.errors = []

      if (!this.$data.forename) {
        this.errors.push('Name required')
      }

      if (!this.$data.email) {
        this.errors.push('Email required')
      }

      if (this.$data.password.length < 5) {
        this.errors.push('Password must be greater than 5 characters')
      }

      if (this.errors.length === 0) {
        return true
      }

      e.preventDefault()
    }
  }
}
</script>
