import { defineStore } from 'pinia'

export const useMensajesAppStore = defineStore('mensajesApp', {
  state: () => ({
    mensaje: '',
    tipoMensaje: 'negative',
    mostrarMensaje: false,
  }),
  getters: {
    mensajeExistente(state): boolean {
      return state.mensaje.length != 0
    },
    tipomensajeExistente(state): boolean {
      return state.tipoMensaje.length != 0
    },
  },
  actions: {
    asignarMensaje(mensaje: string, tipoMensaje: string): void {
      console.log(mensaje)
      this.mensaje = mensaje
      this.tipoMensaje = tipoMensaje
      this.mostrarMensaje = true
    },
  },
})
