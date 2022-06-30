<template>
  <q-page class="flex flex-center">
    <div class="row full-width flex flex-center">
      <div class="col-md-5 col-sm-7 col-xs-10">
        <!-- Content login employee -->
        <q-card>
          <q-card-section>
            <q-avatar size="115px" class="absolute-center shadow-10 logo-card">
              <img src="logo.png" class="bg-deep-purple-1" />
            </q-avatar>
          </q-card-section>

          <q-card-section class="text-center q-pt-xl">
            <div class="text-center col text-h6 ellipsis text-uppercase">
              Primer usuario
            </div>
          </q-card-section>
          <q-card-section class="card-form">
            <q-stepper
              v-model="primerUsuario.paso"
              header-nav
              ref="stepper"
              color="primary"
              animated
            >
              <!-- Usuario persona -->
              <q-step
                :name="1"
                title="Datos personales"
                icon="settings"
                :done="primerUsuario.paso > 1"
                :header-nav="primerUsuario.paso >= 1"
              >
                <q-form class="q-gutter-xs">
                  <div class="row flex flex-center">
                    <div class="col-md-8 col-sm-8 col-xs-12 self-center">
                      <q-item class="flex flex-center">
                        <q-file
                          v-model="primerUsuario.imagenTemp"
                          outlined
                          label="Imagen de empleado"
                          class="full-width flex flex-center"
                          dense
                          accept=".jpg, image/png, image/jpeg"
                          max-file-size="2097152"
                        >
                          <template v-slot:prepend>
                            <q-icon
                              name="fa-solid fa-image"
                              class="text-primary"
                            />
                          </template>
                        </q-file>
                      </q-item>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 flex flex-center">
                      <q-item>
                        <q-img
                          :src="
                            primerUsuario.imagenURL != null
                              ? primerUsuario.imagenURL
                              : 'emptyUser.jpg'
                          "
                          class="imgsquare self-center"
                        />
                      </q-item>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.nombreCompleto"
                          outlined
                          class="full-width"
                          label="Nombre completo"
                          dense
                          maxlength="100"
                          hide-bottom-space
                          :rules="[
                            (val) => val.length > 0,
                            (val) => val.length <= 100,
                          ]"
                        >
                          <template v-slot:prepend>
                            <q-icon
                              name="fa-solid fa-person"
                              class="text-primary"
                            />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.telefono"
                          outlined
                          bottom-slots
                          class="full-width"
                          label="Número de teléfono (opcional)"
                          dense
                          mask="####-####"
                          hide-bottom-space
                        >
                          <template v-slot:prepend>
                            <q-icon
                              name="fa-solid fa-phone"
                              class="text-primary"
                            />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.dui"
                          outlined
                          bottom-slots
                          class="full-width"
                          label="DUI (opcional)"
                          dense
                          mask="########-#"
                          hide-bottom-space
                        >
                          <template v-slot:prepend>
                            <q-icon
                              name="fa-solid fa-id-card"
                              class="text-primary"
                            />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.correo"
                          outlined
                          bottom-slots
                          class="full-width"
                          label="Email"
                          dense
                          maxlength="300"
                          autogrow
                          hide-bottom-space
                        >
                          <template v-slot:prepend>
                            <q-icon name="email" class="text-primary" />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                  </div>

                  <q-stepper-navigation>
                    <q-btn
                      @click="
                        () => {
                          primerUsuario.paso = 2;
                        }
                      "
                      color="primary"
                      label="Continue"
                    />
                  </q-stepper-navigation>
                </q-form>

                <q-card v-if="true" flat bordered class="q-mt-md bg-grey-2">
                  <q-card-section>
                    Submitted form contains empty formData.
                  </q-card-section>
                </q-card>
              </q-step>

              <!-- Nombre de usuario y correo -->
              <q-step
                :name="2"
                title="Credenciales"
                icon="fa-solid fa-user"
                :done="primerUsuario.paso > 2"
                :header-nav="primerUsuario.paso > 2"
              >
                <q-form class="q-gutter-xs">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.nombreUsuario"
                          outlined
                          class="full-width"
                          label="Username"
                          maxlength="100"
                          mask=""
                          :rules="[
                            (val) => val.length > 0,
                            (val) => val.length <= 50,
                            (val) => !val.includes(' '),
                          ]"
                          dense
                          hide-bottom-space
                        >
                          <template v-slot:prepend>
                            <q-icon
                              name="fa-solid fa-user-gear"
                              class="text-primary"
                            />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <q-item>
                        <q-input
                          v-model="primerUsuario.contrasenia"
                          outlined
                          bottom-slots
                          class="full-width"
                          label="Password"
                          :type="
                            primerUsuario.contraseniaVisible
                              ? 'text'
                              : 'password'
                          "
                          maxlength="100"
                          :rules="[
                            (val) =>
                              val.length > 0 || 'Please enter a password',
                            (val) => val.length <= 74 || 'Too long password',
                          ]"
                          dense
                          hide-bottom-space
                        >
                          <template v-slot:prepend>
                            <q-icon name="key" class="text-primary" />
                          </template>
                          <template v-slot:append>
                            <q-icon
                              :name="
                                primerUsuario.contraseniaVisible
                                  ? 'visibility'
                                  : 'visibility_off'
                              "
                              class="cursor-pointer"
                              @click="primerUsuario.cambiarContraseniaVisible"
                            />
                          </template>
                        </q-input>
                      </q-item>
                    </div>
                  </div>
                  <q-stepper-navigation>
                    <q-btn
                      @click="
                        () => {
                          primerUsuario.paso = 3;
                        }
                      "
                      color="primary"
                      label="Continue"
                    />
                    <q-btn
                      flat
                      @click="primerUsuario.paso = 1"
                      color="primary"
                      label="Back"
                      class="q-ml-sm"
                    />

                    <div align="right">
                      <q-btn
                        label="Create First User"
                        type="submit"
                        color="primary"
                      />
                    </div>
                  </q-stepper-navigation>
                </q-form>
              </q-step>

              <q-card v-if="true" flat bordered class="q-mt-md bg-grey-2">
                <q-card-section>
                  Submitted form contains empty formData.
                </q-card-section>
              </q-card>
            </q-stepper>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { usePrimerUsuarioStore } from 'src/stores/sitioPrincipal/login/primer-usuario';

export default defineComponent({
  setup() {
    const primerUsuario = usePrimerUsuarioStore();
    return {
      primerUsuario,
    };
  },
});
</script>

<style lang="scss">
.imgsquare {
  height: 75px;
  width: 75px;
  border: 1px solid black;
}

.q-field__bottom {
  display: none;
}
</style>
