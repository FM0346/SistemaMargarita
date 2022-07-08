import { defineStore } from 'pinia'
import { api } from 'src/boot/axios' // Importa la api para realizar consultas
import { useMensajesAppStore } from 'src/stores/mensajesApp' // Importa el controlador mensajesApp

const mensajesApp = useMensajesAppStore()

export const usePrimerUsuarioStore = defineStore('primerUsuario', {
  state: () => ({
    // Configuración formulario primer usuario
    siEsPrimerUsuario: false as boolean, // Booleano que determina si es el primer usuario (0 usuarios)
    noEsPrimerUsuario: false as boolean, // Booleano que determina si no es el primer usuario ( > 0 usuarios)

    paso: 1 as number, // número que determina el paso del formulario

    // Paso 1: imagen y nombre completo
    imagen: null as File | null,
    imagenURL: null as string | null,
    imagenEstilo: 1 as number, // Estilo de imagen 1 cuadrado, 0 cículo
    nombreCompleto: 'César Esaú Flores Martínez' as string,

    // Paso 2: teléfono, dui y correo
    telefono: '2333-3333' as string,
    dui: '06586511-2' as string,
    correo: '20200346@ricaldone.edu.sv' as string,

    // Paso 3:
    nombreUsuario: 'Admin' as string,
    contrasenia: 'Admin' as string,
    contraseniaConfirmar: 'Admin' as string,
  }),
  actions: {
    // Método que crea la url de la imagen en caso de que exista
    cargarImagen() {
      // si no hay imagen retorna
      if (this.imagen == null) return
      // crea la url de la imagen
      this.imagenURL = URL.createObjectURL(this.imagen)
    },

    // Limpia (setea a null) la imagen y url creada
    limpiarImagen() {
      this.imagen = null
      this.imagenURL = null
    },

    //  Método que llama a la api para validar el primer usuario
    async apiValidarPrimerUsuario(): Promise<void> {
      try {
        // Llama a la API
        const response = await api({
          method: 'get',
          url: '/primer-usuario/validar',
          timeout: 1000 * 10,
        })

        // Respuesta no satisfactoria

        if (response['status'] != 200) throw 'No se pudo obtener una respuesta satisfactoria de la API'
        if (response['data']['status'] != 1) throw response['data']['error']

        // Respuesta satisfactoria
        this.siEsPrimerUsuario = response['data']['data']['primer-usuario'] == true
        this.noEsPrimerUsuario = response['data']['data']['primer-usuario'] == false
      } catch (error) {
        // console.log(error)
        if (typeof error == 'string') return mensajesApp.asignarMensaje(error, 'negative')
        mensajesApp.asignarMensaje('No se pudo conectar al servidor', 'negative')
      }
    },

    //  Método que llama a la api para validar el primer usuario
    async apiCrearPrimerUsuario(): Promise<void> {
      const data = new FormData()
      if (this.imagen != null) data.append('imagen', this.imagen)
      data.append('nombre_completo', this.nombreCompleto)
      data.append('telefono', this.telefono)
      data.append('dui', this.dui)
      data.append('correo', this.correo)
      data.append('nombre_usuario', this.nombreUsuario)
      data.append('contrasenia', this.contrasenia)

      try {
        // Llama a la API a

        const response = await api({
          method: 'post',
          url: '/primer-usuario/crear',
          timeout: 1000 * 10,
          data: data, // datos de primer usuario
        })

        // Respuesta no satisfactoria
        if (response['status'] != 200) throw 'No se pudo obtener una respuesta satisfactoria de la API'
        if (response['data']['status'] != 1) throw response['data']['error']

        // Respuesta satisfactoria
        this.noEsPrimerUsuario = true
      } catch (error) {
        console.log(error)
        if (typeof error == 'string') return mensajesApp.asignarMensaje(error, 'negative')
        mensajesApp.asignarMensaje('No se pudo conectar al servidor', 'negative')
      }
    },
  },
})
