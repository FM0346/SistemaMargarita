import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    redirect: '/login',


  },
  {
    path: '/primer-usuario',
    component: () => import('src/layouts/sitioPrincipal/LoginLayout.vue'),
    children: [
      {
        path: '/primer-usuario', component: () => import('pages/sitioPrincipal/primerUsuario/PrimerUsuarioCreacion.vue')
      }
    ],
  },

   {
    path: '/login',
    component: () => import('src/layouts/sitioPrincipal/LoginLayout.vue'),
    children: [
      {
        path: '/login', component: () => import('pages/sitioPrincipal/login/LoginAcceso.vue')
      }
    ],
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
