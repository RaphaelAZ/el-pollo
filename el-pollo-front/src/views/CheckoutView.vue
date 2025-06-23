<script setup lang="ts">
import OrderPay from '@/components/order/OrderPay.vue'
import type { OrderPayValues, PaidOrder } from '@/models/order.ts'
import LoadingDialog from '@/components/common/LoadingDialog.vue'
import { useBasketStore } from '@/stores/basketStore.ts'
import { ref } from 'vue'
import { useSnackbarStore } from '@/stores/snackBarStore.ts'
import { SnackBarStatus } from '@/models/snackBarParams.ts'
import { useOrderStore } from '@/stores/orderStore.ts'
import router from '@/router'

const basketStore = useBasketStore()
const snackbarManager = useSnackbarStore()
const orderStore = useOrderStore()

const isPageLoading = ref<boolean>(false)

const handleOrderPaid = async (formData: OrderPayValues): Promise<void> => {
  isPageLoading.value = true

  const orderFormData = {
    items: basketStore.basket,
    place: formData,
    orderedAt: new Date()
  } as PaidOrder

  await orderStore
    .publishOrder(orderFormData)
    .then((r) => {
      console.log(r)
      basketStore.resetBasket()
      router.push('/checkout/confirm')
    })
    .catch((e) => {
      console.log(e)

      snackbarManager.showSnackbar({
        message: "Une erreur inconnue est survenue lors de l'ajout de votre commande",
        status: SnackBarStatus.ERROR,
        timer: 50000
      })
    })
    .finally(() => {
      isPageLoading.value = false
    })
}
</script>

<template>
  <div class="relative">
    <v-container>
      <h1 class="mb-3 text-center">Paiement de la commande</h1>

      <OrderPay class="mt-5" @order-paid="handleOrderPaid" />
    </v-container>

    <LoadingDialog :visible="isPageLoading" />
  </div>
</template>

<style scoped></style>
