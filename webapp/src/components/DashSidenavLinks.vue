<template>
  <div v-if="!link.sublinks">
    <q-item :class="levelClass" id="productos" v-ripple clickable :to="link.route">
      <q-item-section avatar>
        <q-icon :name="link.icon" />
      </q-item-section>
      <q-item-section> {{ link.title }}</q-item-section>
    </q-item>
  </div>
  <div v-else>
    <q-expansion-item :icon="link.icon" :label="link.title" expand-icon-class="text-primary">
      <DashSidenavLinks v-for="sublink in link.sublinks" :key="sublink.title" :link="sublink" :level="level + 1" />
    </q-expansion-item>
    <q-separator />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'DashLinks',
  props: {
    link: {
      type: Object,
      required: true,
    },
    level: {
      type: Number,
      required: true,
    },
  },
  computed: {
    levelClass: function () {
      // calcula la clase a utilizar dado el nivel
      return 'level-' + this.level
    },
  },
})
</script>
