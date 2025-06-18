<script setup lang="ts">
import type { PropType } from 'vue'
import type { Burger, Drink } from '@/models/consumable.ts'

const props = defineProps({
  items: {
    type: Object as PropType<(Drink | Burger)[]>,
    required: true,
  },
  total: {
    type: Number,
    required: true
  }
})

const calculateSingleItemTotal = (quantity: number|undefined, price: number|undefined): string => {
  if( !quantity || !price ) {
    return '';
  }

  return `${quantity * price} €`
}

</script>

<template>
  <v-sheet>
    <h3>Total de la commande</h3>
    <h4>{{ props.total }} €</h4>

    <v-divider></v-divider>

    <v-list>
      <v-list-item
        v-for="(consumable, key) in items"
        :key="key"
        :prepend-avatar="consumable.image"
      >
        <v-row>
          <v-col col="5">
            {{ consumable.name }}
          </v-col>

          <v-col col="2">
            <Icon icon="mdi:multiply" />
            {{ consumable.quantity }}
            <Icon icon="mdi:equal" />
          </v-col>

          <v-col col="5">
            {{ calculateSingleItemTotal(consumable.quantity, consumable.price) }}
          </v-col>
        </v-row>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>


  </v-sheet>
</template>

<style scoped>

</style>
