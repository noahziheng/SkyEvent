import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App'
import IndexPages from './Pages/Index'
import EventsPages from './Pages/Events'

Vue.use(VueRouter)
var router = new VueRouter()
router.map({
  '/': {
    component: IndexPages
  },
  '/events': {
    component: EventsPages
  }
})
router.start(App, '#app')
