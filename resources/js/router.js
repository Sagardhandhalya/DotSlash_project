import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        { path: '/home', component: require('./components/Home').default },
        { path: '/create-school', component: require('./components/school/Create-School').default },
        { path: '/admins/:id', component: require('./components/users/AdminList').default},
        { path: '/classes', component: require('./components/school/Classes').default},
        { path: '/users', component: require('./components/school/Users').default},
        { path: '/students/:id', component:require('./components/users/SectionStudents').default },
        { path: '/courses/:id', component: require('./components/course/SectionCourses').default},
    ]
})

export default router
