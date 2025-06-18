import { defineStore } from 'pinia'
import type { Burger, Drink } from '@/models/consumable'

interface BasketState {
    basket: Array<Burger | Drink> | null
}

export const useBasketStore = defineStore('basket', {
  state: (): BasketState => {
    return {
        basket: null 
    }
  },
  actions: {
    addItem(item: Drink | Burger): void {
        this.basket?.push(item);
    },

    removeItem(id: string): void {
        this.basket?.map((item, index) => {
            if(item.id.toString() === id) {
                this.basket?.slice(index);
            }
        })
    },

    resetBasket(): void {
        this.basket = null;
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