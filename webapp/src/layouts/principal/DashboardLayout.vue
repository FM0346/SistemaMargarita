<template>
  <q-layout view="lHh Lpr lFf">
    <!--Header con logo y página actual-->
    <q-header id="navbar" class="bg-image" height-hint="64" elevated>
      <!--Toolbar: prácticamente todo el sidenav-->
      <q-toolbar class="q-pr-md q-pl-md">
        <!--Botón toggle para el sidenav, solo aparece debajo de cierto tamaño-->
        <q-btn v-if="$q.screen.lt.md" dense flat round icon="menu" @click="panelIzquierdo = !panelIzquierdo" />
        <q-toolbar-title>
          <!--Título de la página actual-->
          {{ estructura.titulo }}
        </q-toolbar-title>

        <!--Foto usuario y dropdown funciones de usuario-->
        <q-btn round dense flat>
          <!--Foto del usuario-->
          <q-avatar>
            <!-- <img src="/dashboard/img/general/foto_ejemplo.jpg" /> -->
          </q-avatar>
          <!--menú dropdown-->

          <q-menu anchor="bottom left" self="top left" id="userDropdown">
            <q-list>
              <!--Botón mi cuenta-->
              <q-item clickable to="/dashboard/micuenta">
                <q-item-section avatar>
                  <q-icon class="text-primary" name="person" />
                </q-item-section>
                <q-item-section>Mi cuenta</q-item-section>
              </q-item>

              <!--Botón cerrar sesión-->
              <q-item clickable to="/login">
                <q-item-section avatar>
                  <q-icon class="text-red" name="close" />
                </q-item-section>
                <q-item-section>Cerrar sesión</q-item-section>
              </q-item>
            </q-list>
          </q-menu>
        </q-btn>
      </q-toolbar>

      <!--Barra de navegación de las páginas, en forma de tabs-->
      <q-tabs
        v-if="Object.keys(estructura.accionesPagina).length"
        align="left"
        class="bg-secondary text-primary"
        inline-label
        keep-alive="true"
      >
        <div v-for="tab in estructura.accionesPagina" :key="tab.title">
          <q-route-tab
            class="text-primary"
            :to="tab.route"
            :label="tab.title"
            :icon="tab.icon"
            :disable="tab.disabled() == true"
          />
        </div>
      </q-tabs>
    </q-header>

    <!--Sidenav-->
    <q-drawer
      id="sidenav"
      :width="240"
      class="text-black"
      v-model="panelIzquierdo"
      side="left"
      elevated
      content-class="column justify-between"
      show-if-above
    >
      <div class="absolute-top text-primary" id="sidenavTop">
        <q-toolbar class="q-pr-none q-pl-none bg-primary">
          <!--Sidenav en caso de tener tamaño lg o superior-->
          <q-toolbar-title class="flex flex-center q-pr-none q-pl-none">
            <q-img src="~assets/images/logoWhite.png" fit="fill" height="35px" width="37px"></q-img>
            <span class="text-white font-sofia self-center q-pl-xs">Sistema Margarita</span>
          </q-toolbar-title>
        </q-toolbar>

        <!--Logo/Main-->
        <q-item class="level-0 flex flex-center q-pa-none q-pt-sm q-pb-sm" v-ripple clickable to="/dashboard/main">
          <q-img src="~assets/images/logoPastoralCaritativaCircle.png" fit="contain" height="150px"></q-img>
        </q-item>
        <q-separator />
      </div>

      <!--Botones de navegación-->
      <q-scroll-area id="sidenavLinks">
        <q-list>
          <DashSidenavLinks v-for="link in estructura.linksPagina" :key="link.title" :link="link" :level="0" />
        </q-list>
      </q-scroll-area>

      <div class="absolute-bottom text-primary" id="sidenavBottom">
        <!--Ajustes-->
        <q-separator />

        <q-item class="level-0" clickable to="/dashboard/ajustes">
          <q-item-section avatar>
            <q-icon name="settings" />
          </q-item-section>
          <q-item-section>Ajustes</q-item-section>
        </q-item>
      </div>
    </q-drawer>

    <!--Contenido-->
    <q-page-container>
      <router-view />
    </q-page-container>

    <!--Footer-->
    <q-footer class="bg-image" elevated>
      <q-toolbar class="q-pl-lg q-pr-lg">
        ©2022 Donaciones Margarita
        <q-space />
        <q-btn flat round dense icon="fa-solid fa-envelope" href="#" />
        <q-btn
          flat
          round
          dense
          icon="fa-brands fa-facebook"
          href="https://www.facebook.com/Parroquia-Divina-Providencia-PP-Agustinos-458612290984930"
          target="__blank"
        />
        <q-btn
          flat
          round
          dense
          icon="fa-brands fa-youtube"
          href="https://www.youtube.com/channel/UCQIKownfcZ-b6a-hemPmy3Q"
          target="__blank"
        />
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useEstructuraStore } from 'src/stores/principal/estructura'
import DashSidenavLinks from '../../components/DashSidenavLinks.vue'
import { useLoginStore } from 'src/stores/principal/login'
export default defineComponent({
  setup() {
    const estructura = useEstructuraStore()
    const panelIzquierdo = ref(false)
    const login = useLoginStore()

    return {
      estructura,
      panelIzquierdo,
      login,
    }
  },
  components: { DashSidenavLinks },
  mounted() {
    this.login.apiObtenerInfoUsuario()
  },
})
</script>
