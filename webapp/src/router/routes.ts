import { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  //* Estructura de la webapp
  {
    path: '/',
    //* Todos los sitios utilizan el layout AppLayout
    component: () => import('src/layouts/AppLayout.vue'),
    children: [
      //* Index redirige al acceso del login
      {
        path: '/',
        redirect: '/login/acceso',
      },
      {
        path: '/primer-usuario/registro',
        component: () => import('src/layouts/PrimerUsuarioLayout.vue'),
        children: [
          {
            path: '/primer-usuario/registro',
            component: () => import('src/pages/PrimerUsuarioRegistro.vue'),
          },
        ],
      },
      {
        path: '/login/acceso',
        component: () => import('src/layouts/principal/LoginLayout.vue'),
        children: [
          {
            path: '/login/acceso',
            component: () => import('pages/principal/login/LoginAcceso.vue'),
          },
        ],
      },
    ],
  },
  //* Error sitio no encontrado
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
