import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Home from '../views/Home.vue'
import Profile from '../views/Profile.vue'

const isAuthenticated = () => !!localStorage.getItem('token')

const routes = [
  { path: '/', component: Home, beforeEnter: (to, from, next) => isAuthenticated() ? next() : next('/login') },
  { path: '/login', component: Login },
  { path: '/me', component: Profile, beforeEnter: (to, from, next) => isAuthenticated() ? next() : next('/login') },
]

export default createRouter({
  history: createWebHistory(),
  routes,
})