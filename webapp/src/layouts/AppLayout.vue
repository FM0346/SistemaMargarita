<template>
  <q-layout>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { useMensajesAppStore } from 'src/stores/mensajesApp'
import { useQuasar } from 'quasar'

export default defineComponent({
  name: 'AppLayout',
  setup() {
    const q = useQuasar()
    const mensajesApp = useMensajesAppStore()
    const cargarMensaje = () => {
      if (mensajesApp.tipomensajeExistente) {
        q.notify({
          message: mensajesApp.mensaje,
          type: mensajesApp.tipoMensaje,
          progress: true,
          position: 'bottom',
          badgeStyle: 'opacity: 0',
          timeout: 3000,
        })
        return
      }
      q.notify({
        message: mensajesApp.mensaje,
        progress: true,
        position: 'bottom',
        badgeStyle: 'opacity: 0',
        timeout: 3000,
      })
    }

    return { mensajesApp, cargarMensaje }
  },
  watch: {
    'mensajesApp.mostrarMensaje'() {
      if (this.mensajesApp.mostrarMensaje == false) return
      this.cargarMensaje()
      this.mensajesApp.mostrarMensaje = false
    },
  },
  created() {
    // redirige al origen
    // this.$router.push('/')
  },
})
</script>
