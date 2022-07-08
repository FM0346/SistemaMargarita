<template>
  <!-- Layout-->
  <q-layout class="fondo-primario">
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>

  <q-dialog v-model="primerUsuario.siEsPrimerUsuario" persistent>
    <q-card class="dialog-mini">
      <q-card-section>
        <div class="text-h6 q-pb-sm text-uppercase">Primer usuario</div>

        <q-separator />

        <div class="q-pt-lg">
          <q-avatar icon="fa-solid fa-user-gear" color="primary" text-color="white" />
          <span class="q-ml-lg align-right">Ingreso del primer usuario</span>
        </div>
        <div class="q-pt-lg">Ingrese los datos para la creación del primer usuario administrador/a.</div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="Continuar" class="bg-primary" color="white" to="/primer-usuario/registro" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { usePrimerUsuarioStore } from 'src/stores/primerUsuario'

export default defineComponent({
  name: 'LoginLayout',
  setup() {
    return { primerUsuario: usePrimerUsuarioStore() }
  },
  mounted() {
    this.primerUsuario.apiValidarPrimerUsuario()
  },
})
</script>
