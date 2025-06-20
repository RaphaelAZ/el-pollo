import { defineStore } from 'pinia'
import type { BasketConsumable, Burger, Consumable, Drink } from '@/models/consumable'
import type { OrderPayValues } from '@/models/order.ts'

interface BasketState {
    basket: Array<Burger | Drink>
}

export const useBasketStore = defineStore('basket', {
  state: (): BasketState => {
    return {
        basket: []
    }
  },
  actions: {
    addItem(item: Drink | Burger): void {
        this.basket?.push(item);
    },

    /**
     * Removes one item form the basket
     */
    removeOneOf(toRemove: Burger|Drink): void {
      let alreadyDeleted = false;

      this.basket = this.basket.filter((item: Burger|Drink, index) => {

        if(item.id === toRemove.id && !alreadyDeleted) {
          this.basket?.slice(index);
          alreadyDeleted = true
        }

      })
    },

    resetBasket(): void {
        this.basket = [];
    },

    /**
     * Returns the total of the basket or null if no baskets are available
     */
    getTotal(round: boolean = true): number|null {
      if( !this.basket ) {
        return null;
      }

      const rawValue = this.basket.reduce(
        (accumulator, current) => accumulator + current.price,
        0
      )

      if( round ) {
        return Math.floor( rawValue * 100 ) / 100
      }

      return rawValue
    },

    /**
     * Returns a summary of the current basket.
     */
    getBasketSummary(): BasketConsumable[] {

      //console.log(this.basket)

      //value is the number of this item in the basket
      const basketItemsGroup: Map<Consumable, number> = new Map()

      this.basket?.forEach(( current: Drink|Burger ) => {

        let newQuantity = 1;

        if( basketItemsGroup.has(current) ) {
          newQuantity = basketItemsGroup.get(current) as number + 1
          //console.log("a cet item", current, basketItemsGroup.get(current))
        }

        basketItemsGroup.set(current as Consumable, newQuantity)
      })

      //and calculate the total from the map
      const basketItemsWithTotal: BasketConsumable[] = []

      basketItemsGroup.forEach((nbrOfItems: number, consumable: Consumable) => {

        const singleBasketTotalItem = {
          ...consumable,
          quantity: nbrOfItems,
          total: consumable.price * nbrOfItems
        } as BasketConsumable

        basketItemsWithTotal.push(singleBasketTotalItem)
      })

      return basketItemsWithTotal
    },

    /**
     * Sends the order to the back-end
     * @param formData
     */
    sendOrderToApi(formData: OrderPayValues): Promise<boolean> {

      return new Promise((resolve, reject) => {
        const apiTimeout = Math.floor( (Math.random() * 3600) + 1500 )

        //80% chance to resolve
        setTimeout(() => {
          if( Math.random() >= 0.8 ) {
            resolve(true)
          } else {
            reject(false)
          }
        }, apiTimeout)
      })

    }
  },
  getters: {
    activeBasket: (state) => state,
    isConsumableAlreadyIn: (state): ((id: string) => boolean) => {
        return (id: string): boolean => {
            if(!!state.basket) {
                return state.basket!.some(item => item.id.toString() === id);
            }
            return false

        }
    }
  },
})
