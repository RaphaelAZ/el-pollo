<script setup lang="ts">
import OrderBanner from '@/components/order/OrderBanner.vue'
import type { Consumable } from '@/models/consumable.ts'
import OrderItemCard from '@/components/order/OrderItemCard.vue'
import { getConsumableTypeForItem } from '@/utils/consumable-utils.ts'
import { onMounted, ref } from 'vue'
import { getHttpClient } from '@/plugins/http-client.ts'
import type { ConsumableState } from '@/stores/consumableStore.ts'

const getItems = () => {
  getHttpClient()
    .get('/api/consumables')
    .then((r) => {
      const data = r.data as ConsumableState

      itemsRef.value = data.burgers
    })
    .catch((e) => {
      console.log(e)
    })
}

const itemsRef = ref<Consumable[]|null>(null)

onMounted(() => {
  getItems()
})

</script>

<template>
  <section v-if="itemsRef">
    <OrderBanner :items="itemsRef as Consumable[]" />

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem">
      <OrderItemCard
        v-for="(item, key) in itemsRef"
        :item="item"
        :type="getConsumableTypeForItem(item)"
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
