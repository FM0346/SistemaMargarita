import { StringValidator } from 'src/assets/ts/stringValidator';
import { apiResult } from 'src/assets/ts/apiResult';
import { api } from 'src/boot/axios';
import { defineStore } from 'pinia';

export const usePrimerUsuarioStore = defineStore('primer-usuario', {
  state: () => ({
    //tabla
    imagen: null,
    imagenURL: null,
    nombreCompleto: '',
    correo: '',
    dui: '',
    telefono: '',
    nombreUsuario: '',
    contrasenia: '',

    //configuración
    imagenTemp: null,
    paso: 1,
    contraseniaVisible: false,
    textError: '',
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

    async apiValidarPrimerUsuario(): Promise<apiResult | null> {
      try {
        const response = await api({
          method: 'get',
          url: '/primer-usuario/validar',
          timeout: 1000 * 10,
        });

        if (response['status'] == 200) {
          if (response['data']['status']) return response['data'];
          throw response['data']['errorMessage'];
        }
        throw 'No se pudo conectar al servidor';
      } catch (error) {
        console.log('Error: ' + error);
        return null;
      }
    },

    async validarPrimerUsuario(): Promise<boolean> {
      const response = await this.apiValidarPrimerUsuario();
      if (response == null) return false;
      return response['data']['primer-usuario'] == true;
    },
  },
});
