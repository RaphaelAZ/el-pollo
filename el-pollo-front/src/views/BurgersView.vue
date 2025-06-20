<script setup lang="ts">
import type { Burger } from '@/models/consumable.ts'
import { ref, watch } from 'vue'
import { useConsumableStore } from '@/stores/consumableStore';
import ListItemCard from '@/components/lists/ListItemCard.vue'

const consumableStore = useConsumableStore();
const itemsRef = ref<Burger[] | null>();

watch(() => consumableStore.allBurgers,
  (values) => {
    itemsRef.value = values;
  },
  { immediate: true }
)
</script>

<template>
  <h1>
    Liste des burgers disponibles
  </h1>
  <section v-if="itemsRef">
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem">
      <ListItemCard
        v-for="(item, key) in itemsRef"
        :item="item"
        :key="key"
      />
    </div>
  </section>

  <section v-else>
    <v-progress-circular />
    <h1>Chargement...</h1>
  </section>
</template>

<style scoped lang="ts">

</style>
