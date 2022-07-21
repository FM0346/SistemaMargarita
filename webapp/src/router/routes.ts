import { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  // Estructura de la wepApp
  {
    path: '/',
    redirect: '/login/acceso',
  },
  // Principal, redirige a /login/acceso
  {
    path: '/',
    component: () => import('src/layouts/AppLayout.vue'),
    children: [
      // Primer usuario
      {
        path: '/primer-usuario/',
        component: () => import('src/layouts/PrimerUsuarioLayout.vue'),
        // Hijos
        children: [
          {
            // Registro de primer usuario
            path: '/primer-usuario/registro',
            component: () => import('src/pages/PrimerUsuarioRegistro.vue'),
          },
        ],
      },

      // Login
      {
        path: '/login/',
        component: () => import('src/layouts/principal/LoginLayout.vue'),
        children: [
          {
            path: '/login/acceso',
            component: () => import('pages/principal/login/LoginAcceso.vue'),
          },
        ],
      },

      // Dashboard
      {
        path: '/dashboard/',
        component: () => import('src/layouts/principal/DashboardLayout.vue'),
        children: [
          {
            path: '/dashboard/main',
            component: () => import('pages/principal/dashboard/DashboardMain.vue'),
            meta: {
              title: 'Donaciones Margarita',
            },
          },
        ],
      },
    ],
  },

  // Caso de error
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
]

export default routes
