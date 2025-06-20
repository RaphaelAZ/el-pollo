<script setup lang="ts">
import OrderBanner from '@/components/order/OrderBanner.vue'
import type { Burger, Drink } from '@/models/consumable.ts'
import { ref, watch } from 'vue'
import { useBasketStore } from '@/stores/basketStore.ts'
import { getTotalForItem } from '@/utils/consumable-utils.ts'

const basketStore = useBasketStore()

const itemsRef = ref< (Drink|Burger)[] >(basketStore.activeBasket)
const totalOrderRef = ref<number>(basketStore.getTotal() as number)

const tableHeaders = [
  { title: 'Nom', sortable: true, key: 'name' },
  { title: 'Quantité', sortable: true, key: 'quantity' },
  { title: 'Total', sortable: true, key: 'total' },
  { title: 'Actions', sortable: false, key: 'actions' }
]

/**
 * Add one item to the basket
 * @param item
 */
const addOneItem = (item: Burger|Drink): void => {
  basketStore.addItem( item )
}

const removeOneItem = (item: Drink|Burger): void => {
  basketStore.removeOneOf( item )
}

watch(
  basketStore.basket,
  (newBasket, oldBasket): void => {
    itemsRef.value = basketStore.activeBasket
    totalOrderRef.value = basketStore.getTotal() as number
  }
)

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

    <template #item.actions="{ item }">

      <div class="flex flex-column ga-5">
        <v-btn class="line-action-btn" color="error" @click="removeOneItem(item)">
          <Icon icon="mdi:minus-one" />
        </v-btn>

        <v-btn class="line-action-btn" color="info" @click="addOneItem(item)">
          <Icon icon="mdi:plus-one" />
        </v-btn>
      </div>

    </template>
  </v-data-table>

  <div v-else>
    <h2>Vous n'avez pas de commande.</h2>
  </div>
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
