import { defineStore } from 'pinia'

export const useLoginStore = defineStore('login', {
  state: () => ({
    // Configuración tabla iniciar sesión
    nombre_usuario: '',
    contrasenia: '',
  }),
  getters: {},
  actions: {},
})
