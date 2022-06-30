<template>
  <q-layout>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { usePrimerUsuarioStore } from 'src/stores/sitioPrincipal/login/primer-usuario';

export default defineComponent({
  name: 'PrimerUsuarioLayout',
  setup() {
    return {};
  },

  async beforeCreate() {
    const validarPrimerUsuario =
      await usePrimerUsuarioStore().validarPrimerUsuario();
    if (!validarPrimerUsuario) {
      //this.$router.push({ path: '/dashboard/login/first-user' })
    }
  },
  async beforeUpdate() {
    const validarPrimerUsuario =
      await usePrimerUsuarioStore().validarPrimerUsuario();
    if (!validarPrimerUsuario) {
      //this.$router.push({ path: '/dashboard/login/first-user' })
    }
  },
});
</script>

<style lang="scss">
body {
  background-image: linear-gradient(
    90deg,
    $primary 0%,
    $secondary 40%,
    $secondary 60%,
    $primary 100%
  );
}

.normal_link {
  color: grey;
  text-decoration: none;
}
</style>
