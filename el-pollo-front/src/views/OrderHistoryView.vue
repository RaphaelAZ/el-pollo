<script setup lang="ts">
import { useOrderStore } from '@/stores/orderStore.ts'
import SinglePaidOrder from '@/components/order/SinglePaidOrder.vue'
import { onMounted, ref } from 'vue'
import type { PreviousPaidOrder } from '@/models/order.ts'
import { SnackBarStatus } from '@/models/snackBarParams.ts'
import { useSnackbarStore } from '@/stores/snackBarStore.ts'
import LoadingDialog from '@/components/common/LoadingDialog.vue'

const ordersStore = useOrderStore()
const snackbarManager = useSnackbarStore()

const oldOrdersRef = ref<PreviousPaidOrder[]>([])

const isLoading = ref<boolean>(false)

onMounted(() => {
  isLoading.value = true

  ordersStore
    .fetchPreviousOrders()
    .then((hasFetched) => {

      if( hasFetched ) {
        oldOrdersRef.value = ordersStore.previousOrders
      } else {
        throw new Error("Error when fetching older orders")
      }

    })
    .catch((e) => {
      console.log(e)

      snackbarManager.showSnackbar({
        message: 'Erreur inconnue lors de la récupération de vos précédentes commandes',
        status: SnackBarStatus.ERROR,
      })
    })
    .finally(() => {
      isLoading.value = false
    })
  ;
})
</script>

<template>
  <v-container v-if="oldOrdersRef.length > 0">
    <h1 class="text-center mb-5">Commandes précédentes</h1>

    <div id="previous-orders-grid">
      <article
        v-for="(order, key) in oldOrdersRef"
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

  <loading-dialog :visible="isLoading" />
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
