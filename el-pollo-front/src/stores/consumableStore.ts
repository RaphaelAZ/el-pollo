import { defineStore } from 'pinia'
import { getHttpClient } from '@/plugins/http-client'
import type { Burger, Consumable, Drink } from '@/models/consumable'

export interface ConsumableState {
    burgers: Burger[] | null;
    drinks: Drink[] | null;
    ingredients: string[] | null;
}

export const useConsumableStore = defineStore('consumables', {
  state: (): ConsumableState => {
    return {
      burgers: null,
      drinks: null,
      ingredients: null
    }
  },
  actions: {
    async getAllConsumable(): Promise<boolean> {
        try {
          const response = await getHttpClient().get('api/consumables');
          const data = response.data as ConsumableState;
          this.burgers = data.burgers;
          this.drinks = data.drinks;
          this.ingredients = data.ingredients;
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
    allIngredients: (state) => state.ingredients
  },
})
