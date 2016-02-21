<template>
  <div>
    <navbar></navbar>
    <router-view></router-view>
    <div class="container">
      <hr>
      <!-- Footer -->
      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; SkyEvent 2016 <span class="pull-right">Create by Ziheng Gao</span></p>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar'
import UserModel from './model/user'
import Events from './model/events'
import Version from './version.json'
import Cookies from 'js-cookie'

export default {
  created: function () {
    if (this.$route.auth) {
      Cookies.set('usertoken', this.$route.params.token)
      /* this.$http.post(this.baseurl + '/events', {logintoken}).then(function (response) {
        console.log('Test Succeed')
        console.log(response)
      }, function (response) {
        console.log('Test Error')
        console.log(response)
      }) */
    }
  },
  components: {
    Navbar
  },
  data: function () {
    return {
      version: Version,
      events: Events,
      user: new UserModel()
    }
  },
  methods: {
    language: function (lang) {}
  }
}
</script>

<style>
body {
    padding-top: 50px;
}

footer {
    margin: 50px 0;
}
.vlink {
  cursor: pointer;
}
</style>