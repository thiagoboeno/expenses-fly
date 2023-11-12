import { RouteLocationNormalized, NavigationGuardNext } from 'vue-router';

const auth = (_to: RouteLocationNormalized, _from: RouteLocationNormalized, next: NavigationGuardNext) => {
  if (!localStorage.getItem('api-client-token')) {
    return next('/login');
  }

  return next();
};


export default auth;
