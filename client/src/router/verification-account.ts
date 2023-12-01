import { RouteRecordRaw } from 'vue-router';
import auth from './guards/auth';

const routes: RouteRecordRaw[] = [
  {
    path: '/verification-account',
    component: () => import('layouts/MainLayout.vue'),
    beforeEnter: auth,
    children: [{ path: '', component: () => import('pages/VerificationAccountPage.vue'), }],
  },
];

export default routes;
