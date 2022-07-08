<template>
  <q-layout class="fondo-primario">
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>

  <q-dialog v-model="primerUsuario.noEsPrimerUsuario" persistent>
    <q-card class="dialog-mini">
      <q-card-section>
        <div class="text-h6 q-pb-sm text-uppercase">Usuario creado</div>
        <q-separator />
        <div class="q-pt-lg">
          <q-avatar icon="fa-solid fa-info" color="blue-6" text-color="white" />
          <span class="q-ml-lg align-right">Primer usuario creado</span>
        </div>
        <div class="q-pt-lg">Primer usuario creado exitosamente, proceda a iniciar sesión</div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="Continuar" class="bg-primary" color="white" to="/login/acceso" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { usePrimerUsuarioStore } from 'src/stores/primerUsuario'

export default defineComponent({
  name: 'PrimerUsuarioLayout',
  setup() {
    return { primerUsuario: usePrimerUsuarioStore() }
  },
  mounted() {
    this.primerUsuario.apiValidarPrimerUsuario()
  },
})
</script>
