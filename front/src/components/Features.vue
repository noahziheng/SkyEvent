<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>近期活动</h3>
      </div>
    </div>

    <div class="row text-center">
      <div class="col-md-3 col-sm-6 hero-feature" v-for="event in events">
        <div class="thumbnail">
          <img src="{{ event.image }}" alt="">
          <div class="caption">
            <h3>{{ event.title }}</h3>
            <p>{{ event.description }}</p>
            <p>
              <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style>
.hero-feature {
  margin-bottom: 30px;
}
</style>
