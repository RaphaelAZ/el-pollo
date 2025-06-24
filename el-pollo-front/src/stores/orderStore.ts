import { defineStore } from 'pinia'
import type { PaidOrder, PreviousPaidOrder } from '@/models/order.ts'
import { getHttpClient } from '@/plugins/http-client.ts'

export const useOrderStore = defineStore('ordersHistory', {
  state: (): OrdersHistoryStoreState => {
    return {
      previousOrders: [],
    }
  },
  actions: {
    /**
     * Vas donner la commande au serveur, qui vas la traiter
     * @param order
     */
    async publishOrder(order: PaidOrder): Promise<boolean> {
      try {
        const response = await getHttpClient().post('api/order/new', order)

        return !!response
      } catch (e) {
        console.log(e)
        return false
      }
    },

    /**
     * Vas chercher les dernières commandes de l'utilisateur et les mettre dans le store.
     */
    async fetchPreviousOrders(): Promise<boolean> {
      return await getHttpClient().get('api/order/old')
        .then((r) => {
          this.previousOrders = r.data as PreviousPaidOrder[]

          return true
        })
        .catch((e) => {
          console.log(e)

          this.previousOrders = []
          return false
        })
    },
  },
})

export interface OrdersHistoryStoreState {
  previousOrders: PreviousPaidOrder[]
}
