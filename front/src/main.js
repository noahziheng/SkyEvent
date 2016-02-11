/*!
 * SkyEvent Web前端 入口
 * SkyEvent Web Front-End Enterance
 * (c) 2016 Ziheng Gao
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import i18n from 'vue-i18n'
import ZhMsg from './lang/zh'
import EnMsg from './lang/en'
import IndexPages from './Pages/Index'
import EventsPages from './Pages/Events'

// ready translated locales
var locales = {
  en: EnMsg,
  zh: ZhMsg
}

var language = navigator.browserLanguage ? navigator.browserLanguage : navigator.language
language = language.substr(0, 2)
if (language !== 'zh' && language !== 'en') {
  language = 'en'
}

// set plugin
Vue.use(i18n, {
  lang: language,
  locales: locales
})
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
Vue.directive('lang', function (lang) {
  console.log(lang)
  // Vue.config.lang = lang
  console.log(Vue.config.lang)
})
import App from './App'
router.start(App, '#app')
