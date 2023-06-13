import Vue from 'vue'
import App from './App'
import store from './store' // store
import plugins from './plugins' // plugins
import './permission' // permission
Vue.use(plugins)

Vue.config.productionTip = false
Vue.prototype.$store = store

import uView from '@/uni_modules/uview-ui'
Vue.use(uView)

App.mpType = 'app'

const app = new Vue({
  ...App
})

app.$mount()
