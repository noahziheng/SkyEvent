import Cookies from 'js-cookie'

export default {
  set: function (lang) {
    Cookies.set('language', lang)
  },
  get: function () {
    var language = Cookies.get('language')
    if (!language) {
      language = navigator.browserLanguage ? navigator.browserLanguage : navigator.language
      language = language.substr(0, 2)
    }
    if (language !== 'zh' && language !== 'en') {
      language = 'en'
    }
    return language
  }
}
