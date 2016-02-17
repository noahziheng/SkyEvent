<template>
  <!-- Page Content -->
  <div class="container">
    <div class="hero-spacer">
      <div class="row">
        <div class="col-lg-8">
          <div class="well">
            <h1>{{ event.title }}</h1>
            <p class="lead">by <a href="#">Start Bootstrap</a></p>
            <hr>
            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>
            <hr>
            <!-- Preview Image -->
            <img class="img-responsive" :src="event.image" alt="">
            <hr>
            <!-- Post Content -->
            <p class="lead">{{ event.description }}</p>
          </div>
          <div class="well ">
            <h4>Leave a Comment:</h4>
            <form role="form">
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
          <!-- Blog Search Well -->
          <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
              <input type="text" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
            <!-- /.input-group -->
          </div>

          <!-- Blog Categories Well -->
          <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">Category Name</a></li>
                  <li><a href="#">Category Name</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">Category Name</a></li>
                  <li><a href="#">Category Name</a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Side Widget Well -->
          <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data: function () {
    return {
      event: this.$root.events.get(this.$route.params.id)
    }
  }
}
</script>

<style>
.hero-spacer {
    margin-top: 50px;
}
</style>
