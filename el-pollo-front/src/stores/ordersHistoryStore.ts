import { defineStore } from 'pinia'
import type { PaidOrder } from '@/models/order.ts'

export const useOrdersHistoryStore = defineStore('ordersHistory', {
  state: (): OrdersHistoryStoreState => {
    return {
      previousOrders: []
    }
  },
  actions: {

    insertOrder(order: PaidOrder) {
      order.orderedAt ??= new Date()

      this.previousOrders.push(order)
    }

  }
})

export interface OrdersHistoryStoreState {
  previousOrders: PaidOrder[]
}
