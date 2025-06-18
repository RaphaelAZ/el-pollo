<script setup lang="ts">
import OrderBanner from '@/components/order/OrderBanner.vue'
import type { Burger, Drink } from '@/models/consumable.ts'
import OrderItemCard from '@/components/order/OrderItemCard.vue'
import { getConsumableTypeForItem } from '@/utils/consumable-utils.ts'
import { onMounted, ref } from 'vue'
import { useBasketStore } from '@/stores/basketStore.ts'
import { getHttpClient } from '@/plugins/http-client.ts'
import OrderSummary from '@/components/order/OrderSummary.vue'

const basketStore = useBasketStore()

const itemsRef = ref< (Drink|Burger)[] >(basketStore.basket as (Drink|Burger)[])

onMounted(() => {
  const id = Math.round(Math.random() * 27)

  getHttpClient()
    .get(`/api/burgers/${id}`)
    .then((r) => {
      r.data.quantity = Math.floor( Math.random() * 4 ) + 1

      basketStore.addItem(r.data)

      console.log(basketStore.basket)
    })
    .catch((e) => {
      console.log(e)
    })
})
</script>

<template>
  <OrderBanner :items="basketStore.basket" />

  <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem">
    <OrderItemCard
      v-for="(item, key) in itemsRef"
      :item="item"
      :type="getConsumableTypeForItem(item)"
      :key="key"
    />
  </div>

  <v-divider></v-divider>

  <!-- container for the right-resume -->
  <div class="position-fixed right-0 top-0 w-full">
    <OrderSummary
      :total="basketStore.getTotal(true) as number"
      :items="itemsRef"
    />
  </div>
</template>

<style scoped lang="ts">

</style>
