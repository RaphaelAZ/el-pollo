import { defineStore } from 'pinia'
import type { Burger, Drink } from '@/models/consumable'

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
      const targetItem = this.basket.find((currentItem: Drink|Burger) => {
        return currentItem.id === item.id
      })

      if( !targetItem ) {

        const newItem = {
          ...item,
          quantity: 1
        }

        this.basket.push(newItem);
      } else {

        this.basket = this.basket.map((currentItem: Burger|Drink) => {
          if( currentItem.id === item.id ) {
            (currentItem.quantity as number)++
          }

          return currentItem
        })
      }


    },

    /**
     * Removes one item form the basket
     */
    removeOneOf(toRemove: Burger|Drink): void {
      this.basket = this.basket.map( (currentItem: Burger|Drink) => {
        if( currentItem.id === toRemove.id ) {
          currentItem.quantity!--
        }

        return currentItem
      } )

      //filtrage des quantités invalides dans le pannier
      this.basket = this.basket.filter( (currentItem: Burger|Drink) => currentItem.quantity > 0 )
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
        (accumulator, current) => accumulator + (current.price * current.quantity as number),
        0
      )

      if( round ) {
        return Math.floor( rawValue * 100 ) / 100
      }

      return rawValue
    },
  },
  getters: {
    activeBasket: (state) => state.basket,
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
