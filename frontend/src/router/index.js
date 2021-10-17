import {createRouter, createWebHistory} from 'vue-router'
import Home from '@/components/views/Home.vue'
import Login from "@/components/views/Login";
import Profile from "@/components/views/Profile";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile
    },


]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
