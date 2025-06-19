<script setup lang="ts">
import { useConsumableStore } from '@/stores/consumableStore.ts'
import { onMounted } from 'vue'
import SingleDrinkCard from '@/components/drinks/SingleDrinkCard.vue'

const consumableStore = useConsumableStore()

onMounted(() => {
  consumableStore.getAllConsumable()
})

</script>

<template>
  <h1>Toutes les boissons</h1>

  <template v-if="consumableStore.allDrinks">

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); grid-gap: 2rem">
      <SingleDrinkCard
        v-for="(drink, key) in consumableStore.allDrinks"
        :key="key"
        :drink="drink"
      />
    </div>
  </template>

  <template v-else>
    <v-progress-circular></v-progress-circular>
    Chargement...
  </template>

</template>

<style scoped>

</style>
