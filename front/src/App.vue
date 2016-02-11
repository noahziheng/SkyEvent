<template>
  <div>
    <navbar></navbar>
    <router-view></router-view>
    <div class="container">
      <hr>
      <!-- Footer -->
      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; SkyEvent 2016</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar'

export default {
  components: { Navbar }
}
</script>

<style>
body {
    padding-top: 50px;
}

footer {
    margin: 50px 0;
}
</style>
