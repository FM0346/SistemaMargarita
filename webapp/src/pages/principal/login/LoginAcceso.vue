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
          <q-card-section>
            <!-- sección del formulario -->
            <q-form
              class="q-gutter-lg"
              greedy
              autocorrect="off"
              autocapitalize="off"
              autocomplete="off"
              spellcheck="false"
            >
              <q-input
                label="Nombre de usuario o correo electrónico"
                outlined
                hide-bottom-space
                v-model="login.nombre_usuario"
                maxlength="255"
                clear-icon="close"
                :rules="[(val) => val.length > 0 || 'Ingresa un nombre de usario o correo electrónico']"
              >
                <template v-slot:prepend>
                  <q-icon name="fa-solid fa-user" class="text-primary" />
                </template>
              </q-input>

              <q-input
                label="Password"
                outlined
                hide-bottom-space
                v-model="login.contrasenia"
                :type="login.contraseniaVisible ? 'text' : 'password'"
                maxlength="100"
                :rules="[(val) => val.length > 0 || 'Ingresa una contraseña']"
                autocomplete="off"
              >
                <template v-slot:append>
                  <q-icon
                    :name="login.contraseniaVisible ? 'visibility' : 'visibility_off'"
                    class="cursor-pointer"
                    @click="login.cambiarContraseniaVisible"
                  />
                </template>
                <template v-slot:prepend>
                  <q-icon name="key" class="text-primary" />
                </template>
              </q-input>
              <div align="right">
                <router-link to="/dashboard/login/recover-password" class="normal-link">
                  ¿Olvidaste tu contraseña?
                </router-link>
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
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { useLoginStore } from 'src/stores/principal/login'

export default defineComponent({
  setup() {
    const login = useLoginStore()
    return {
      login,
    }
  },
})
</script>
