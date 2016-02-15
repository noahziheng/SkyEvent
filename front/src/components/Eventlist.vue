<template>
  <div v-for="event in events">
    <div class="row">
      <div class="col-md-7">
        <a href="#">
          <img class="img-responsive" :src="event.image" alt="">
        </a>
      </div>
      <div class="col-md-5">
        <h3>{{ event.title }}</h3>
        <h4>Subheading</h4>
        <p>{{ event.description }}</p>
        <a class="btn btn-primary" href="#">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
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
