import { StringValidator } from 'src/assets/ts/stringValidator';
import { apiResult } from 'src/assets/ts/apiResult';
import { api } from 'src/boot/axios';
import { defineStore } from 'pinia';

export const useLoginStore = defineStore('login', {
  state: () => ({
    //tabla
    nombre_usuario: '',
    contrasenia: '',

    //configuración
    contraseniaVisible: false,
  }),
  getters: {},
  actions: {
    cambiarContraseniaVisible(): void {
      this.contraseniaVisible = !this.contraseniaVisible;
    },

    validarUsuario(str: string): boolean {
      return StringValidator.isUsername(str);
    },

    validarContrasenia(str: string) {
      return str.length > 0 && str.length < 74;
    },
  },
});
