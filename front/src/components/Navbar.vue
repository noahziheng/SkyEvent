<template>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="true">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">SkyEvent</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div id="bs-navbar"  class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                  <li v-link="{ path: '/', exact: true, activeClass: 'active' }">
                      <a v-link="{ path: '/' }">{{ $t('message.home') }}</a>
                  </li>
                  <li v-link="{ path: '/events', exact: true, activeClass: 'active' }">
                      <a v-link="{ path: '/events' }">{{ $t('message.event') }}</a>
                  </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <!-- languages selector -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">语言 / Languages <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a class="vlink" @click="lang('zh')">简体中文 (Simplified Chinese)</a></li>
                    <li><a class="vlink" @click="lang('en')">English</a></li>
                  </ul>
                </li>
                <!-- Userbar -->
                <userbar></userbar>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
</template>

<script>
import Userbar from './Userbar'

export default {
  components: {
    Userbar
  },
  methods: {
    lang: function (lang) {
      this.$parent.language(lang)
    }
  }
}
</script>

<style>
</style>
