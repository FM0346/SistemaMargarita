import { defineStore } from 'pinia'
import { tabAction, sidenavLink } from 'src/assets/ts/models'

export const useEstructuraStore = defineStore('estructura', {
  state: () => ({
    // Configuración tabla iniciar sesión
    titulo: '' as string, // Nombre de la página
    accionesPagina: [] as Array<tabAction>, // Acciones posibles de la página
    linksPagina: [
      {
        title: 'Inventario',
        icon: 'fa-solid fa-box',
        sublinks: [
          {
            title: 'Productos',
            icon: 'layers',
            route: '/dashboard/inventario',
          },
          {
            title: 'Categorías',
            icon: 'widgets',
            route: '/dashboard/categorias',
          },
        ],
      },
      {
        title: 'Usuarios',
        icon: 'fa-solid fa-user',
        route: '/dashboard/usuarios',
      },
    ] as Array<sidenavLink>, // Acciones posibles de la página
  }),
  getters: {},
  actions: {},
})
