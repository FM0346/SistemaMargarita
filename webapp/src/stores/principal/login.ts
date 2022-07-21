import { defineStore } from 'pinia'
import { api } from 'src/boot/axios' // Importa la api para realizar consultas
import { useMensajesAppStore } from 'src/stores/mensajesApp' // Importa el controlador mensajesApp
import { loginData } from 'src/assets/ts/models'
const mensajesApp = useMensajesAppStore()

export const useLoginStore = defineStore('login', {
  state: () => ({
    // Configuración tabla iniciar sesión
    usuario: '',
    contrasenia: '',

    // Validación de acceso
    accesoUsuario: false, // impide o admite el acceso

    // Datos de usuario
    userData: {} as loginData,
  }),
  getters: {},
  actions: {
    async apiValidarAcceso() {
      try {
        // Llama a la API
        const response = await api({
          method: 'get',
          url: '/login/validar',
          timeout: 1000 * 10,
        })

        // Respuesta no satisfactoria

        if (response['status'] != 200) throw 'No se pudo obtener una respuesta satisfactoria de la API'
        if (response['data']['status'] != 1) throw response['data']['error']

        this.accesoUsuario = response['data']['data']['acceso'] == true
      } catch (error) {
        // console.log(error)
        if (typeof error == 'string') return mensajesApp.asignarMensaje(error, 'negative')
        mensajesApp.asignarMensaje('No se pudo conectar al servidor', 'negative')
      }
    },
    async apiIniciarAcceso() {
      try {
        const data = new FormData()
        data.append('usuario', this.usuario)
        data.append('contrasenia', this.contrasenia)

        // Llama a la API
        const response = await api({
          method: 'post',
          url: '/login/iniciar',
          timeout: 1000 * 10,
          data: data, // datos de acceso
        })

        // Respuesta no satisfactoria
        if (response['status'] != 200) throw 'No se pudo obtener una respuesta satisfactoria de la API'
        if (response['data']['status'] != 1) throw response['data']['error']

        if (response['data']['data']['acceso'] == false)
          mensajesApp.asignarMensaje('Usuario o contraseña incorrecto', 'negative')
        this.accesoUsuario = response['data']['data']['acceso'] == true
      } catch (error) {
        // console.log(error)
        if (typeof error == 'string') return mensajesApp.asignarMensaje(error, 'negative')
        mensajesApp.asignarMensaje('No se pudo conectar al servidor', 'negative')
      }
    },

    async apiObtenerInfoUsuario() {
      try {
        // Llama a la API
        const response = await api({
          method: 'get',
          url: '/login/obtener-info',
          timeout: 1000 * 10,
        })

        // Respuesta no satisfactoria
        if (response['status'] != 200) throw 'No se pudo obtener una respuesta satisfactoria de la API'
        if (response['data']['status'] != 1) throw response['data']['error']

        this.userData.id = response['data']['data']['id']
        this.userData.nombre_usuario = response['data']['data']['nombre_usuario']
        this.userData.correo = response['data']['data']['correo']
        this.userData.imagen = response['data']['data']['imagen']
      } catch (error) {
        // console.log(error)
        if (typeof error == 'string') return mensajesApp.asignarMensaje(error, 'negative')
        mensajesApp.asignarMensaje('No se pudo conectar al servidor', 'negative')
      }
    },
  },
})
