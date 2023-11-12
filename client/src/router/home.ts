import { RouteRecordRaw } from 'vue-router';
import auth from './guards/auth';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    beforeEnter: auth,
    children: [{ path: '', component: () => import('pages/IndexPage.vue'), }],
  },
];

export default routes;
