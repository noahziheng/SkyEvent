<template>
  <div class="container">
    <div class="jumbotron hero-spacer">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-header">{{ $t('index.events') }}
          </h2>
        </div>
      </div>

      <eventlist></eventlist>
    </div>
  </div>
</template>

<script>
import Eventlist from '../components/Eventlist'

export default {
  components: {
    Eventlist
  }
}
</script>

<style>
.hero-spacer {
    margin-top: 50px;
}
</style>
