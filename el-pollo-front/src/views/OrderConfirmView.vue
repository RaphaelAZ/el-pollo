<script setup lang="ts">
import { useUserStore } from '@/stores/userStore.ts'

const commonIconsClass = "position-absolute w-33 h-auto opacity-30"

const userStore = useUserStore()
</script>

<template>
  <section class="relative overflow-hidden">

    <v-container class="d-flex align-center justify-center h-screen w-screen flex-column ga-5">
      <h1>Votre commande a bien été prise en compte</h1>
      <h2 class="font-italic font-weight-light">
        Merci de votre commande et bon appétit, <i>{{ userStore.activeUser }}</i> !
      </h2>

      <v-btn to="/home" size="large" color="info">
        <Icon icon="mdi:home" />
        Retour à l'accueil
      </v-btn>
    </v-container>

    <!-- icons -->
    <Icon id="top-left-icon" :class="`${commonIconsClass} left-0 top-0`" icon="emojione:hamburger" />
    <Icon id="bot-right-icon" :class="`${commonIconsClass} right-0 bottom-0`" icon="emojione:fork-and-knife" />
  </section>
</template>

<style scoped>
#top-left-icon {
  transform: rotate(-24deg);
}
</style>
