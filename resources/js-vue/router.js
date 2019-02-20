import Vue from 'vue'
import Router from 'vue-router'
import store from './store.js'


// Views
import Home from './components/Home'
import User from './components/User'


Vue.use(Router)

const routes = [

    {
        path: '/',
        name: 'home',
        component: Home
    },

    {
        path: '/about',
        name: 'about',
        component: Home
    },

    {
        path: '/terms',
        name: 'terms',
        component: Home
    },


    {
        path: '/user',
        name: 'user',
        component: User,
        children: [
           {
                path: 'profile',
                name: 'user_profile',
                component: User
           },
           {
                path: 'posts',
                name: 'user_posts',
                component: User
            },
            {
                path: 'friends',
                name: 'user_friends',
                component: User
            },
        ],
        meta: { 
            requiresAuth: true
        }
    },
    
]


let router = new Router({
  //mode: 'history',
  routes: routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (store.getters.isLoggedIn) {
      next()
      return
    }
    next('/login') 
  } else {
    next() 
  }
})

export default router