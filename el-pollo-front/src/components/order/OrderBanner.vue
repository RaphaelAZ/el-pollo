<script setup lang="ts">
import { computed, type PropType } from 'vue'
import type { Consumable } from '@/models/consumable'
import { sIfCount } from '@/utils/string-utils.ts'

const props = defineProps({
  items: {
    type: Array as PropType<Consumable[]>,
    required: false,
    default: () => null
  }
})

/**
 * Computed sub-title string from the
 */
const computedSubTitleText = computed(() => {
  if( props.items && props.items.length > 0 ) {
    const itemsLength = props.items.length

    return `${itemsLength} ${sIfCount('élement', itemsLength)} dans le pannier.`
  }

  return 'Pas de commande.'
})
</script>

<template>
  <h1>Résumé de la commande</h1>

  <p> {{ computedSubTitleText }} </p>
</template>

<style scoped>

</style>
