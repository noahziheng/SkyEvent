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
import User from './model/user'
import Events from './model/events'
import Version from './version.json'

export default {
  components: {
    Navbar
  },
  data: function () {
    return {
      version: Version,
      user: User,
      events: Events
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