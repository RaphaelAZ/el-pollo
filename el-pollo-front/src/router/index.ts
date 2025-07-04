import { useUserStore } from './../stores/userStore';
import HomeView from '@/views/HomeView.vue'
import { createRouter, createWebHistory, type NavigationGuardNext, type RouteLocationNormalized } from 'vue-router'
import OrderView from '@/views/OrderView.vue'
import DrinksView from '@/views/DrinksView.vue'
import BurgersView from '@/views/BurgersView.vue'
import CheckoutView from '@/views/CheckoutView.vue'
import OrderConfirmView from '@/views/OrderConfirmView.vue'
import BuilderView from '@/views/BuilderView.vue'
import OrderHistoryView from '@/views/OrderHistoryView.vue'
import LoginView from '@/views/LoginView.vue';
import RegisterView from '@/views/RegisterView.vue';
import PolloView from '@/views/PolloView.vue';

const onlyPublicRoutes = [
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      beforeEnter: [NotAuthGuard],
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      beforeEnter: [NotAuthGuard],
    },
]

const publicRoutes = [
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
      path: '/builder',
      name: 'builder',
      component: BuilderView
    },
    {
      path: '/pollo',
      name: 'pollo',
      component: PolloView
    }
];

const protectedRoute = [
  {
    path: '/order',
    name: 'order',
    component: OrderView,
    beforeEnter: [AuthGuard],
  },
  {
    path: '/drinks',
    name: 'drinks',
    component: DrinksView,
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: CheckoutView,
    beforeEnter: [AuthGuard],
  },
  {
    path: '/checkout/confirm',
    name: 'checkout-confirm',
    component: OrderConfirmView,
    beforeEnter: [AuthGuard],
  },
  {
    path: '/order/history',
    name: 'previous-orders',
    component: OrderHistoryView,
    beforeEnter: [AuthGuard],
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    ...onlyPublicRoutes,
    ...publicRoutes,
    ...protectedRoute
  ]
});

function AuthGuard(to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext) {
  const trueUserStore = useUserStore();

  if( trueUserStore.isLoggedIn ) {
    next();
  } else {
    next('/home');
  }
}

function NotAuthGuard(to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext) {
  const trueUserStore = useUserStore();

  if( !trueUserStore.isLoggedIn ) {
    next();
  } else {
    next('/home');
  }
}

export default router
