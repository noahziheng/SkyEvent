<template>
  <div class ="container">
    <div class="jumbotron hero-spacer">
      <h1 class="text-center">SkyEvent  <small>v{{ version.num }} {{ version.sign }}</small></h1>
      <p class="text-center"><small>{{ $t('message.current_version') }}: v{{ version.num }} {{ version.sign }} build{{ version.build }}</small></p>
      <p>{{ $t('index.description') }}</p>
      <p>
        <a v-link="{ path: '/events' }" class="btn btn-primary btn-lg">{{ $t('index.events') }}</a>
        <a v-link="{ path: '/flights' }" class="btn btn-primary btn-lg">{{ $t('index.flights') }}</a>
        <a v-link="{ path: '/logs' }" class="btn btn-primary btn-lg">{{ $t('index.versionlog') }}</a>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      version: this.$root.version
    }
  }
}
</script>

<style>
.hero-spacer {
    margin-top: 50px;
}
</style>
