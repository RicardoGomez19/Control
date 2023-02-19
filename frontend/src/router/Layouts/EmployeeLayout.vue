<template>
  <v-layout>
    <v-app-bar color="light-blue-darken-2" elevation="2">
      <v-app-bar-title>Impulso Like - Control</v-app-bar-title>
      <v-spacer />
      <v-btn variant="outlined" @click="changeMode">Marcar {{ mode }}</v-btn>
    </v-app-bar>
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>

<script setup lang="ts">
import { useEmployeeLayoutMode } from '../../composable/EmployeeLayoutMode'
const { changeMode, mode } = useEmployeeLayoutMode()

</script>