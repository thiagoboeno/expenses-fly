import { RouteRecordRaw } from 'vue-router';

import HomeRoute from './home';
import AuthRoutes from './auth'
import ProfileRoute from './profile';
import ExpensesRoutes from './expenses'
import NotFoundRoute from './not-found'

const routes: RouteRecordRaw[] = [
  ...HomeRoute,
  ...AuthRoutes,
  ...ProfileRoute,
  ...ExpensesRoutes,
  ...NotFoundRoute,
];

export default routes;
