import { defineStore } from 'pinia'
import type { Burger, Consumable, Drink } from '@/models/consumable'

interface ConsumableState {
    burgers: Burger[] | null;
    drinks: Drink[] | null;
    others: Consumable[] | null;
}

export const useUserStore = defineStore('consumables', {
  state: (): ConsumableState => {
    return {
      burgers: null,
      drinks: null,
      others: null
    }
  },
  actions: {
    getAllConsumable(user: string): void {
        try {
            //   this.burgers = TODO: Appel API Burgers Axios
        } catch(e) {
            console.error(e);
        }
    }
  },
  getters: {
    allBurgers: (state) => state.burgers,
    allDrinks: (state) => state.drinks,
    allOthers: (state) => state.others
  },
})