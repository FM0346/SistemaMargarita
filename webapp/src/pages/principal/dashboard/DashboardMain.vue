<template>
  <q-page class="text-center q-pa-lg">
    <span class="text-h5"> Bienvenido usuario - {{ login.userData.nombre_usuario }} </span>
  </q-page>
</template>
<script lang="ts">
import { useLoginStore } from 'src/stores/principal/login'
import { defineComponent } from 'vue'

export default defineComponent({
  setup() {
    const login = useLoginStore()
    return { login }
  },
})
</script>
