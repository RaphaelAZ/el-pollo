import HomeView from '@/views/HomeView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import OrderView from '@/views/OrderView.vue'
import BurgersView from '@/views/BurgersView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/burgers',
      name: 'burgers',
      component: BurgersView,
    },
    {
      path: '/order',
      name: 'order',
      component: OrderView
    }
  ],
})

export default router
