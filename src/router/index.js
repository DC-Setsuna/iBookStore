import Vue from 'vue'
import Router from 'vue-router'

import Homepage from '@/components/Homepage'
import Highsearch from '@/components/Highsearch'
import Ranking from '@/components/Ranking'
import Car from '@/components/Car'
import User from '@/components/User'
import Bookdetail from '@/components/Bookdetail'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Homepage',
      component: Homepage
    },
    {
      path: '/highsearch',
      name: 'Highsearch',
      component: Highsearch
    },
    {
      path: '/ranking',
      name: 'Ranking',
      component: Ranking
    },
    {
      path: '/car',
      name: 'Car',
      component: Car
    },
    {
      path: '/user',
      name: 'User',
      component: User
    },
    {
      path: '/bookdetail/:bookid',
      name: 'Bookdetail',
      component: Bookdetail
    }
  ]
})
