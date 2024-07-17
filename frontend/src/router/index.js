import { createRouter, createWebHistory } from 'vue-router'
import { isUserLoggedIn } from './utils'
import {routes} from './routes';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const userData = JSON.parse(localStorage.getItem('userData') || '{}')
  const userRole = userData && userData.role ? userData.role : null

  if(to.meta.requiresAuth && !isUserLoggedIn() && to.name != 'login') {
    next('/login');
  } else if((to.name == 'register' || to.name == 'login') && isUserLoggedIn()) {
    next('/');
  } else {
    if (to.meta.role && userRole) {
      // Checking if a currentUser has a suitable role
      if (to.meta.role != userRole.name) {
        next('/login');
      }
    }
  }

  next();
});


// Docs: https://router.vuejs.org/guide/advanced/navigation-guards.html#global-before-guards
export default router
