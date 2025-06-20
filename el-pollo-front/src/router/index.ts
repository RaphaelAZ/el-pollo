import HomeView from '@/views/HomeView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import OrderView from '@/views/OrderView.vue'
import DrinksView from '@/views/DrinksView.vue'
import BurgersView from '@/views/BurgersView.vue'
import CheckoutView from '@/views/CheckoutView.vue'
import OrderConfirmView from '@/views/OrderConfirmView.vue'

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
    },
    {
      path: '/drinks',
      name: 'drinks',
      component: DrinksView,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: CheckoutView
    },
    {
      path: '/checkout/confirm',
      name: 'checkout-confirm',
      component: OrderConfirmView,
    }
  ],
})

export default router
