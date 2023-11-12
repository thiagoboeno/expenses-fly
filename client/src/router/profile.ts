import { RouteRecordRaw } from 'vue-router';
import auth from './guards/auth';

const routes: RouteRecordRaw[] = [
  {
    path: '/profile',
    component: () => import('layouts/MainLayout.vue'),
    beforeEnter: auth,
    children: [{ path: '', component: () => import('pages/ProfilePage.vue'), }],
  },
];

export default routes;
