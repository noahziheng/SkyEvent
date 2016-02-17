<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3><strong>近期活动<a class="pull-right vlink"><small>{{ $t('event.more') }}>></small></a></strong></h3>
        
      </div>
    </div>

    <div class="row text-center">
      <div class="col-md-3 col-sm-6 hero-feature" v-for="event in events">
        <div class="thumbnail">
          <img  class="vlink" v-link="{ path: '/event/'+event.id }" :src="event.image" alt="">
          <div class="caption">
            <h3 class="vlink" v-link="{ path: '/event/'+event.id }">{{ event.title }}</h3>
            <p>{{ event.description }}</p>
            <p>
              <a v-link="{ path: '/event/'+event.id }" class="btn btn-primary btn-lg vlink">{{ $t('event.detail') }}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      events: this.$root.events.getAll()
    }
  }
}
</script>

<style>
.hero-feature {
  margin-bottom: 30px;
}
</style>
