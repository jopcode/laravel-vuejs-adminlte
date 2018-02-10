import Login from './pages/Login.vue';
import Admin from './pages/Admin.vue'
import NotFound from './pages/NotFound.vue';

// Import Views
import DashboardView from './pages/views/Dashboard.vue';
import UsersView from './pages/views/Users.vue';

// Routes
const routes = [
  {
    path: '/login',
    component: Login,
    name: 'login',
    meta: { requiresAuth: false },
  },
  {
    path: '/',
    component: Admin,
    meta: { requiresAuth: true },
    children: [
      {
        path: '/',
        component: DashboardView,
        name: 'dashboard',
        meta: {}
      },
      {
        path: '/dashboard',
        redirect: '/',
      },
      {
        path: '/users',
        component: UsersView,
        name: 'users',
        meta: {}
      }
    ]
  },
  {
    // not found handler
    path: '*',
    component: NotFound
  }
];

export default routes;