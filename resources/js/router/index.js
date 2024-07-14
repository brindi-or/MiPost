import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        component: () => import('../components/Login.vue'),
    },
    {
        path: '/home',
        component: () => import('../components/Home.vue'),
        meta: { requiresAuth: true },
    },
    {
            path: '/register',
        component: () => import('../components/Register.vue'),
    }
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) && !store.state.isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;
