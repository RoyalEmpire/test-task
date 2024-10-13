import {createRouter, createWebHistory} from 'vue-router';
import AuthenticatedLayout from '../layouts/Authenticated.vue';

const routes = [
    {
        path: '/',
        component: AuthenticatedLayout,
        children: [
            {
                path: '',
                name: 'Home',
                component: () => import('../pages/Home/HomeIndex.vue')
            },
            {
                path: '/calculation',
                name: 'Calculation',
                component: () => import('../pages/Calculation/CalculationIndex.vue')
            }
        ]
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
