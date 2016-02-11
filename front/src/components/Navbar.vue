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
                  <li v-link="{ path: '/', exact: true, activeClass: 'active' }">
                      <a v-link="{ path: '/' }">首页</a>
                  </li>
                  <li v-link="{ path: '/events', exact: true, activeClass: 'active' }">
                      <a v-link="{ path: '/events' }">活动</a>
                  </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <!-- languages selector -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">语言 / Languages <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a v-lang="zh">简体中文</a></li>
                    <li><a v-lang="en">English</a></li>
                  </ul>
                </li>
                <!-- Userbar -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">C1航路管制员 Ziheng Gao <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
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
