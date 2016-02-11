<template>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">SkyEvent</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                  <li>
                      <a v-link="{ path: '/' }">首页</a>
                  </li>
                  <li>
                      <a v-link="{ path: '/bar' }">活动</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
  </nav>
</template>

<script>
export default {}
</script>

<style>
body {
    padding-top: 70px;
}

footer {
    margin: 50px 0;
}
</style>
