import { RouteRecordRaw } from 'vue-router';

import HomeRoute from './home';
import AuthRoutes from './auth';
import VerificationAccount from './verification-account';
import ProfileRoute from './profile';
import ExpensesRoutes from './expenses';
import NotFoundRoute from './not-found';

const routes: RouteRecordRaw[] = [
  ...HomeRoute,
  ...AuthRoutes,
  ...VerificationAccount,
  ...ProfileRoute,
  ...ExpensesRoutes,
  ...NotFoundRoute,
];

export default routes;
