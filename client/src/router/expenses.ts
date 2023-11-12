import { RouteRecordRaw } from 'vue-router';
import auth from './guards/auth';

const routes: RouteRecordRaw[] = [
  {
    path: '/expenses',
    component: () => import('layouts/MainLayout.vue'),
    beforeEnter: auth,
    children: [
      { path: '', component: () => import('pages/expenses/ExpensesListPage.vue') },
      { path: ':id', component: () => import('pages/expenses/ExpensesShowPage.vue') },
      { path: 'create', component: () => import('pages/expenses/ExpensesCreatePage.vue') },
      { path: ':id/edit', component: () => import('pages/expenses/ExpensesEditPage.vue') }
    ],
  },
];

export default routes;
