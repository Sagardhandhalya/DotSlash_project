import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        { path: '/home', component: require('./components/Home').default },
        // { path: '/create-school', component: require('./components/Create-School').default },
        // { path: '/admins/:id', component: require('./components/users/AdminList').default},
    ]
})

export default router
