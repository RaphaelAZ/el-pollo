<script setup lang="ts">
import { computed, type PropType } from 'vue'
import type { BasketConsumable } from '@/models/consumable'
import { sIfCount } from '@/utils/string-utils.ts'

const props = defineProps({
  items: {
    type: Array as PropType< BasketConsumable[] >,
    required: false,
    default: () => null
  },
  total: {
    type: Number,
    required: false,
    default: () => 0
  }
})

/**
 * Computed sub-title string from the
 */
const computedSubTitleText = computed(() => {
  if( props.items && props.items.length > 0 ) {
    const itemsLength = props.items.length

    return `${itemsLength} ${sIfCount('élement', itemsLength)} dans le pannier`
  }

  return 'Pas de commande.'
})
</script>

<template>
  <h1>Résumé de la commande</h1>

  <template v-if="items.length > 0">
    <p>Total: {{ total }} € <Icon icon="mdi:dot" /> {{ computedSubTitleText }} </p>

    <p class="mt-5">
      <v-btn to="/checkout" color="info">
        <Icon icon="mdi:money" />
        Payer
      </v-btn>
    </p>
  </template>
</template>

<style scoped>

</style>
