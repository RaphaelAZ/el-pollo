<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import NavBar from '@/components/NavBar.vue'
</script>

<template>
  <header>
    <nav>
      <NavBar />
    </nav>
  </header>

  <main>
    <v-container>
      <RouterView />
    </v-container>
  </main>
</template>

<style scoped>
</style>
