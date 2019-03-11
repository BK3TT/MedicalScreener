import Vue from 'vue'
import Router from 'vue-router'
import VueSession from 'vue-session'
import axios from 'axios'

import home from '@/components/home'
import user from '@/components/user'
import survey from '@/components/survey'
import signin from '@/components/signin'
import register from '@/components/register'
import completion from '@/components/completion'

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

window.$ = window.jQuery = require('jquery')

library.add(fas)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(BootstrapVue)
Vue.use(Router)
Vue.use(VueSession)

Vue.prototype.$http = axios

require('@/assets/css/main.css')
require('@/assets/css/header.css')
require('@/assets/css/home.css')
require('@/assets/css/completion.css')
require('@/assets/css/survey.css')
require('@/assets/css/signin.css')
require('@/assets/css/register.css')
require('@/assets/css/user.css')

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    }, {
      path: '/user',
      name: 'user',
      component: user
    }, {
      path: '/survey',
      name: 'survey',
      component: survey
    }, {
      path: '/signin',
      name: 'signin',
      component: signin
    }, {
      path: '/register',
      name: 'register',
      component: register
    }, {
      path: '/completion',
      name: 'completion',
      component: completion
    }
  ]
})
