<template>
  <q-page class="flex flex-center">
    <div class="row full-width flex flex-center">
      <div class="col-md-4 col-sm-7 col-xs-10">
        <!-- Card -->
        <q-card>
          <q-card-section>
            <q-avatar size="115px" class="absolute-center shadow-10 logo-card">
              <img src="~assets/images/logo.png" class="bg-deep-purple-1" />
            </q-avatar>
          </q-card-section>

          <q-card-section class="text-center q-pt-xl">
            <div class="text-center q-pt-md">
              <div class="col text-h6 ellipsis text-uppercase">Portal de ingreso</div>
              <div class="col text-subtitle1 ellipsis text-uppercase">Login</div>
            </div>
          </q-card-section>
          <q-card-section class>
            <!-- sección del formulario -->
            <q-form
              class="q-gutter-lg"
              autocorrect="off"
              autocapitalize="off"
              autocomplete="off"
              spellcheck="false"
              @submit="login.apiIniciarAcceso()"
            >
              <q-input
                label="Nombre de usuario o correo electrónico"
                outlined
                v-model="login.usuario"
                maxlength="255"
                clear-icon="close"
                :rules="[(val) => val.length > 0 || 'Campo vacío']"
              >
                <template v-slot:prepend>
                  <q-icon name="fa-solid fa-user" class="text-primary" />
                </template>
              </q-input>

              <q-input
                label="Password"
                outlined
                v-model="login.contrasenia"
                :type="contraseniaVisible ? 'text' : 'password'"
                maxlength="100"
                :rules="[(val) => val.length > 0 || 'Campo vacío']"
                autocomplete="off"
              >
                <template v-slot:append>
                  <q-icon
                    :name="contraseniaVisible ? 'visibility' : 'visibility_off'"
                    class="cursor-pointer"
                    @click="contraseniaVisible = !contraseniaVisible"
                  />
                </template>
                <template v-slot:prepend>
                  <q-icon name="key" class="text-primary" />
                </template>
              </q-input>
              <div align="right">
                <router-link to="/login/acceso" class="normal-link"> ¿Olvidaste tu contraseña? </router-link>
              </div>

              <!-- Botón submit -->
              <div align="right">
                <q-btn label="Acceder" type="submit" color="primary" />
              </div>
            </q-form>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>

  <q-dialog v-model="login.accesoUsuario" persistent>
    <q-card class="dialog-mini">
      <q-card-section>
        <div class="text-h6 q-pb-sm text-uppercase">Sesión iniciada</div>
        <q-separator />
        <div class="q-pt-lg">
          <q-avatar icon="fa-solid fa-check" color="green-6" text-color="white" />
          <span class="q-ml-lg align-right">Se ha iniciado sesión</span>
        </div>
        <div class="q-pt-lg">Sesión iniciada correctamente</div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="Continuar" class="bg-primary" color="white" to="/dashboard/main" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useLoginStore } from 'src/stores/principal/login'

export default defineComponent({
  setup() {
    const login = useLoginStore()
    return {
      login,
      contraseniaVisible: ref(false), // Visibilidad del campo 'contraseña'
    }
  },
  mounted() {
    //this.login.apiValidarAcceso()
  },
})
</script>
