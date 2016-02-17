<template>
  <!-- Guest -->
  <li class="dropdown" v-if="flaq">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $t('message.guest') }} <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">{{ $t('user.login') }}</a></li>
    </ul>
  </li>
  <!-- User -->
  <li class="dropdown" v-else>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">C1航路管制员 Ziheng Gao <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Action</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">{{ $t('user.logout') }}</a></li>
    </ul>
  </li>
</template>

<script>
var M

export default {
  init: function () {
    M = this.$root.user
  },
  data: function () {
    return {
      flaq: M.getState()
    }
  },
  methods: {
    lang: function (lang) {
      this.$parent.language(lang)
    }
  }
}
</script>

<style>
.vlink {
  cursor: pointer;
}
</style>
