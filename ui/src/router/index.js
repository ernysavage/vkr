import { createRouter, createWebHistory } from 'vue-router'
import Register from '@/views/Register.vue'
import Login from '@/views/Login.vue'
import Dashboard from '@/views/Dashboard.vue'
import About from '@/views/About.vue'

const routes = [
  { path: '/', redirect: '/register' },
  { path: '/register', component: Register },
  { path: '/login', name: 'Login', component: Login },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard },
  { path: '/dashboard/transactions', name: 'DashboardTransactions', component: () => import('@/views/Dashboard/Transactions.vue') },
  { path: '/dashboard/achievements', name: 'DashboardAchievements', component: () => import('@/views/Dashboard/Achievements.vue') },
  { path: '/dashboard/quests', name: 'DashboardQuests', component: () => import('@/views/Dashboard/Quests.vue') },
  { path: '/dashboard/education', name: 'DashboardEducation', component: () => import('@/views/Dashboard/Education.vue') },
  { path: '/about', name: 'About', component: About },
  
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
