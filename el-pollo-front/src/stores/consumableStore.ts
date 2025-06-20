import { defineStore } from 'pinia'
import { getHttpClient } from '@/plugins/http-client'
import type { Burger, Drink, Ingredients } from '@/models/consumable'

export interface ConsumableState {
    burgers: Burger[] | null;
    drinks: Drink[] | null;
    ingredients: Ingredients | null;
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
    allBurgers: (state) => state.burgers as Burger[],
    allDrinks: (state) => state.drinks as Drink[],
    allIngredients: (state) => state.ingredients as Ingredients
  },
})
