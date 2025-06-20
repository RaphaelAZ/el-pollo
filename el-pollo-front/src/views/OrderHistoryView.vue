<script setup lang="ts">
import OrderBanner from '@/components/order/OrderBanner.vue'
import type { Burger, Drink } from '@/models/consumable.ts'
import { ref } from 'vue'
import { useBasketStore } from '@/stores/basketStore.ts'

const basketStore = useBasketStore()

const itemsRef = ref< (Drink|Burger)[] >(basketStore.activeBasket)
const totalOrderRef = ref<number>(basketStore.getTotal() as number)

const tableHeaders = [
  { title: 'Nom', sortable: true, key: 'name' },
  { title: 'Quantité', sortable: true, key: 'quantity' },
  { title: 'Total', sortable: true, key: 'total' },
]

const getTotalForItem = (item: Burger|Drink) => {
  const itemTotalRaw = (item.quantity as number) * item.price

  //arrondir à deux chiffres
  const itemTotal = Math.floor( itemTotalRaw * 100 ) / 100

  if( itemTotal ) {
    return `${itemTotal} €`
  } else {
    return '(Erreur)'
  }
}

</script>

<template>
  <OrderBanner
    :items="itemsRef"
    :total="totalOrderRef"
  />

  <v-data-table
    class="mt-5"
    id="order-summary-table"
    :headers="tableHeaders"
    :items="itemsRef"
    v-if="itemsRef.length > 0"
    :items-per-page="-1"
    hide-default-footer
  >
    <template #item.name="{ item }">
      <div class="d-flex align-center ga-2">
        <v-avatar>
          <v-img
            :src="item.image"
          />
        </v-avatar>

        <span>{{ item.name }}</span>
      </div>
    </template>

    <template #item.total="{ item }">
      {{ getTotalForItem(item as Burger|Drink) }}
    </template>
  </v-data-table>
</template>

<style lang="css">

#order-summary-table {
  background-color: rgb(var(--v-theme-info));

  --borders-table: 2px solid rgb(var(--v-theme-primary));
}

#order-summary-table * {
  color: white;
}

#order-summary-table thead th {
  font-weight: bold;
}

#order-summary-table thead th,
#order-summary-table tbody tr:not(:last-child) td {
  border-bottom: var(--borders-table) !important;
}
</style>
