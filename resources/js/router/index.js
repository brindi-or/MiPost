import { createRouter, createWebHistory } from 'vue-router'
import {useAuthStore} from '../store';



const routes = [
    {
        path: '/api/app/login',
        component: () => import('../components/auth/Login.vue'),
    },
    {
        path: '/',
        component: () => import('../components/Home.vue'),
        meta: { requiresAuth: true },
    },
    {
        path: '/api/register',
        component: () => import('../components/auth/Register.vue'),
    },
        {
            path: '/api/app/profil',
        component: () => import('../components/Profil/UserProfile.vue'),
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
    // const token = useAuthStore.$state.token;
    // const isAuthenticated = useAuthStore.$state.isAuthenticated;
    const authStore = useAuthStore()
    console.log('out', authStore.isAuthenticated)
    if (to.matched.some(record => record.meta.requiresAuth) && !authStore.isAuthenticated) {
        console.log('test')
        next('/api/app/login');
    } else {
        console.log('testno')
        next();
    }
});

export default router;
