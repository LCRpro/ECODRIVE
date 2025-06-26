import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Home from '../views/Home.vue'
import Profile from '../views/Profile.vue'
import ProfileComplete from '../views/ProfileComplete.vue'
import Course from '../views/Course.vue'
import Error404 from '../views/Error404.vue'
import Error500 from '../views/Error500.vue'
import Error403 from '../views/Error403.vue'





const isAuthenticated = () => !!localStorage.getItem('token')

const requireAuth = (to, from, next) => {
  isAuthenticated() ? next() : next('/login')
}

const guardAuth = async (to, from, next) => {
  if (!isAuthenticated()) return next('/login')

  try {
    const res = await fetch('http://localhost:8000/me', {
      headers: { Authorization: 'Bearer ' + localStorage.getItem('token') },
    })
    const user = await res.json()

    if (!user.name || !user.birthday || !user.gender || !user.address) {
      return next('/profile/complete')
    } else {
      return next()
    }
  } catch {
    return next('/login')
  }
}

const routes = [
  { path: '/', component: Home, beforeEnter: guardAuth },
  { path: '/login', component: Login },
  { path: '/me', component: Profile, beforeEnter: requireAuth },
  { path: '/profile/complete', component: ProfileComplete, beforeEnter: requireAuth },
  { path: '/course', component: Course, beforeEnter: requireAuth },
  { path: '/500', name: 'ServerError', component: Error500 },
  { path: '/:pathMatch(.*)*', name: 'NotFound', component: Error404 },
  { path: '/403', name: 'Forbidden', component: Error403 },


  

  
]

export default createRouter({
  history: createWebHistory(),
  routes,
})