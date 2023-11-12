import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/login',
    component: () => import('layouts/ClearLayout.vue'),
    children: [{ path: '', component: () => import('pages/auth/LoginPage.vue') }],
  },
  {
    path: '/sign-up',
    component: () => import('layouts/ClearLayout.vue'),
    children: [{ path: '', component: () => import('pages/auth/SignUpPage.vue') }],
  },
  {
    path: '/forgot-password',
    component: () => import('layouts/ClearLayout.vue'),
    children: [{ path: '', component: () => import('pages/auth/ForgotPasswordPage.vue') }],
  },
  {
    path: '/reset-password/:token',
    component: () => import('layouts/ClearLayout.vue'),
    children: [{ path: '', component: () => import('pages/auth/ResetPasswordPage.vue') }],
  },
];

export default routes;
