import { defineStore } from 'pinia'
import type { PaidOrder } from '@/models/order.ts'
import { v4 as uuidV4 } from 'uuid';

export const useOrdersHistoryStore = defineStore('ordersHistory', {
  state: (): OrdersHistoryStoreState => {
    return {
      previousOrders: []
    }
  },
  actions: {

    insertOrder(order: PaidOrder) {
      order.orderedAt ??= new Date()

      //pour ne pas avoir un énorme string dans l'UUID
      order.uuid = uuidV4().split('-')[0]

      this.previousOrders.push(order)
    }

  }
})

export interface OrdersHistoryStoreState {
  previousOrders: PaidOrder[]
}
