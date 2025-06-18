import { defineStore } from 'pinia'
import { getHttpClient } from '@/plugins/http-client'
import type { Burger, Consumable, Drink } from '@/models/consumable'

interface ConsumableState {
    burgers: Burger[] | null;
    drinks: Drink[] | null;
    others: Consumable[] | null;
}

export const useConsumableStore = defineStore('consumables', {
  state: (): ConsumableState => {
    return {
      burgers: null,
      drinks: null,
      others: null
    }
  },
  actions: {
    async getAllConsumable(user: string): Promise<boolean> {
        try {
          const response = await getHttpClient().get('api/consumables');
          const data = response.data as ConsumableState;
          this.burgers = data.burgers;
          this.drinks = data.drinks;
          return true;
        }
        catch(error) {
          console.log(error)
          return false;
        }
    }
  },
  getters: {
    allBurgers: (state) => state.burgers,
    allDrinks: (state) => state.drinks,
    allOthers: (state) => state.others
  },
})