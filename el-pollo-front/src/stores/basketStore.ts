import { defineStore } from 'pinia'
import type { User } from '@/models/user'
import type { Burger, Drink } from '@/models/consumable'

export const useBasketStore = defineStore('basket', {
  state: (): Array<Drink | Burger > => {
    return []
  },
  actions: {
    add
    fetchUser(user: string): void {
      this.name = user
    }
  },
  getters: {
    activeUser: (state) => state.name
  },
})