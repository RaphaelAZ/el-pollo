<template>
  <h1>Page d'accueil de fou</h1>
  <v-btn @click="testAppel">LES CONSOMMABLES DE FOU</v-btn>
</template>

<script lang="ts" setup>
import { useConsumableStore } from '@/stores/consumableStore';

const consuStore = useConsumableStore();

const testAppel = () => {
  consuStore.getAllConsumable().then(() => {
    console.log(consuStore.allDrinks[0]);
  })
}
</script>
