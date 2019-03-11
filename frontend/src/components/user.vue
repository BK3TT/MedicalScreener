<template>
    <div :id="'theme-' + this.$route.name" class="container">
      <div class='edit' v-on:click="edit_overlay"><font-awesome-icon icon="edit" /></div>
      <div class="card">
          <article class="card-body">
              <h5 class="card-title mb-4 mt-1">{{ this.profile_data.forename + ' ' + this.profile_data.surname }}</h5>
                  <label>Age</label>
                  <p>{{ (this.profile_data.age) ? this.profile_data.age : 'unknown' }}</p>
                  <label>Height</label>
                  <p>{{ (this.profile_data.height) ? this.profile_data.height : 'unknown' }}</p>
                  <label>Weight</label>
                  <p>{{ (this.profile_data.weight) ? this.profile_data.weight : 'unknown' }}</p>
                  <label>Address</label>
                  <p>{{ (this.profile_data.address) ? this.profile_data.address : 'unknown' }}</p>
                  <label>City</label>
                  <p>{{ (this.profile_data.city) ? this.profile_data.city : 'unknown' }}</p>
                  <label>Postcode</label>
                  <p>{{ (this.profile_data.postcode) ? this.profile_data.postcode : 'unknown' }}</p>
          </article>
      </div>
      <div id='edit-profile-overlay' class='bg-secondary'>
        <div class='close' v-on:click="close_overlay">X</div>
        <form id='form-edit-profile' @submit="save_updates">
          <div class="form-group">
            <label>Age</label>
            <input name="age" class="form-control" placeholder="Age" type="number" :value="this.profile_data.age">
          </div>
          <div class="form-group">
            <label>Height</label>
            <input name="height" class="form-control" placeholder="Height" type="text" :value="this.profile_data.height">
          </div>
          <div class="form-group">
            <label>Weight</label>
            <input name="weight" class="form-control" placeholder="Weight" type="text" :value="this.profile_data.weight">
          </div>
          <div class="form-group">
            <label>Address</label>
            <input name="address" class="form-control" placeholder="Address" type="text" :value="this.profile_data.address">
          </div>
          <div class="form-group">
            <label>City</label>
            <input name="city" class="form-control" placeholder="City" type="text" :value="this.profile_data.city">
          </div>
          <div class="form-group">
            <label>Postcode</label>
            <input name="postcode" class="form-control" placeholder="Postcode" type="text" :value="this.profile_data.postcode">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Save updates</button>
          </div>
        </form>
      </div>
    </div>
</template>
<script>
export default {
  name: 'user',
  data () {
    return {
      profile_data: {
        forname: '',
        surname: '',
        age: '',
        height: '',
        weight: '',
        address: '',
        city: '',
        postcode: ''
      }
    }
  },
  created () {
    let that = this
    if (!this.$session.id() || !this.$session.get('id')) {
      that.$router.push('/')
    }
    this.$http.get('http://localhost/api/user/profile/' + that.$session.get('id'))
      .then(function (response) {
        if (response.status === 200) {
          that.profile_data = response.data
        }
      })
      .catch(function (error) {
        console.log(error)
      })
  },
  methods: {
    edit_overlay: function () {
      window.$('#edit-profile-overlay').show()
    },
    close_overlay: function () {
      window.$('#edit-profile-overlay').hide()
    },
    save_updates: function (e) {
      e.preventDefault()
      let that = this
      this.$http({
        method: 'post',
        url: 'http://localhost/api/user/updates/' + that.$session.get('id'),
        data: window.$('#form-edit-profile').serialize(),
        config: {
          headers: { 'Content-Type': 'multipart/form-data' }
        }
      })
        .then(function (response) {
          if (response.status === 200) {
            window.$('#edit-profile-overlay').hide()
            window.location.reload()
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>
