import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App'
import IndexPages from './Pages/Index'

var Foo = Vue.extend({
  template: '<p>This is foo!</p>'
})

var Bar = Vue.extend({
  template: '<p>This is bar!</p>'
})

Vue.use(VueRouter)
var router = new VueRouter()
router.map({
  '/': {
    component: IndexPages
  },
  '/foo': {
    component: Foo
  },
  '/bar': {
    component: Bar
  }
})
router.start(App, '#app')
