import { defineStore } from 'pinia'
import type { User } from '@/models/user'

export const useUserStore = defineStore('user', {
  state: (): User => {
    return {
      name: null
    }
  },
  actions: {
    fetchUser(user: string): void {
      this.name = user
    }
  },
  getters: {
    activeUser: (state) => state.name,
    isLoggedIn: (state): boolean => !!state.name
  },
})