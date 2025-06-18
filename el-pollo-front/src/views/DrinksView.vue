<script setup lang="ts">
import { useConsumableStore } from '@/stores/consumableStore.ts'
import { computed, onMounted } from 'vue'
import SingleDrinkCard from '@/components/drinks/SingleDrinkCard.vue'
import { sIfCount } from '@/utils/string-utils.ts'

const consumableStore = useConsumableStore()

onMounted(() => {
  consumableStore.getAllConsumable()
})

const computedSubtitle = computed(() => {
  if( !consumableStore.allDrinks ) {
    return ''
  }

  const numberOfDrinks = consumableStore.allDrinks.length

  return `${numberOfDrinks} ${sIfCount('boisson', numberOfDrinks)} ${sIfCount('disponible', numberOfDrinks)}`
})

</script>

<template>
  <h1>Toutes les boissons</h1>

  <template v-if="consumableStore.allDrinks">
    <h2>{{ computedSubtitle }}</h2>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr)">
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
