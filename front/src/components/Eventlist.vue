<template>
  <div v-for="event in events">
    <div class="row">
      <div class="col-md-7">
        <a  class="vlink" v-link="{ path: '/event/'+event.id }">
          <img class="img-responsive" :src="event.image" alt="">
        </a>
      </div>
      <div class="col-md-5">
        <h3  class="vlink" v-link="{ path: '/event/'+event.id }">{{ event.title }}</h3>
        <h4>Subheading</h4>
        <p>{{ event.description }}</p>
        <a class="btn btn-primary btn-lg vlink" v-link="{ path: '/event/'+event.id }">{{ $t('event.detail') }} <span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
    </div>
    <hr v-show="hr($index)">
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      events: this.$root.events.getAll()
    }
  },
  methods: {
    hr: function (index) {
      if (this.events.length === index + 1) {
        return false
      } else {
        return true
      }
    }
  }
}
</script>

<style>
</style>
