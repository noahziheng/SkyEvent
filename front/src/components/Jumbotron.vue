<template>
  <div class="container">
    <div class="jumbotron hero-spacer">
      <h1 class="text-center">SkyEvent  <small>v2.0 alpha</small></h1>
      <p class="text-center"><small>{{ $t('message.current_version') }}: v2.0 alpha build20160211</small></p>
      <p>SkyEvent是VATPRC旗下管理各种模拟飞行活动网站，您可以选择您感兴趣活动的活动报名参加，并获得活动有关的信息，您可通过参与活动加入积分评比。更多功能不断加入中...</p>
      <p>
        <a v-link="{ path: '/events' }" class="btn btn-primary btn-lg">{{ $t('index.events') }}</a>
        <a v-link="{ path: '/flights' }" class="btn btn-primary btn-lg">{{ $t('index.flights') }}</a>
        <a v-link="{ path: '/logs' }" class="btn btn-primary btn-lg">{{ $t('index.versionlog') }}</a>
      </p>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style>
.hero-spacer {
    margin-top: 50px;
}
</style>
