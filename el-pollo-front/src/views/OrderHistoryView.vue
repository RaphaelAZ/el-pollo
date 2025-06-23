<script setup lang="ts">
import { useOrderStore } from '@/stores/orderStore.ts'
import SinglePaidOrder from '@/components/order/SinglePaidOrder.vue'

const ordersHistoryStore = useOrderStore()

</script>

<template>
  <v-container v-if="ordersHistoryStore.previousOrders.length > 0">
    <h1 class="text-center mb-5">Commandes précédentes</h1>

    <div id="previous-orders-grid">

      <article
        v-for="(order, key) in ordersHistoryStore.previousOrders"
        :key="key"
        class="h-fit"
      >
        <SinglePaidOrder :order="order" />
      </article>

    </div>
  </v-container>

  <v-container v-else>
    <h1>Aucune commande précédente</h1>
  </v-container>
</template>

<style lang="css">
#previous-orders-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 2rem;
}

.h-fit {
  height: fit-content;
}
</style>
