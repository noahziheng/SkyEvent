/*!
 * SkyEvent Web前端 入口
 * SkyEvent Web Front-End Enterance
 * (c) 2016 Ziheng Gao
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import i18n from 'vue-i18n'
import ZhMsg from './lang/zh'
import EnMsg from './lang/en'
import IndexPages from './Pages/Index'
import EventsPages from './Pages/Events'
import EventPages from './Pages/Event'
import Lang from './lang-detect'

// ready translated locales
var locales = {
  en: EnMsg,
  zh: ZhMsg
}

// set plugin
Vue.use(i18n, {
  lang: Lang.get(),
  locales: locales
})
Vue.use(VueRouter)
Vue.use(VueResource)
var router = new VueRouter()
router.map({
  '/': {
    component: IndexPages
  },
  '/userauth/:token': {
    component: IndexPages,
    auth: true
  },
  '/events': {
    component: EventsPages
  },
  '/event/:id': {
    component: EventPages
  }
})
import App from './App'
App.methods.language = function (lang) {
  Lang.set(lang)
  location.reload()
}
router.start(App, '#app')
