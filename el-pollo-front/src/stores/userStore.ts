import { defineStore } from 'pinia'
import type { LoginData, RegisterData, User } from '@/models/user'
import { getHttpClient } from '@/plugins/http-client.ts'

export const useUserStore = defineStore('user', {
  state: (): User => {
    return {
      username: null,
      email: null,
      jwt: null,
    }
  },
  actions: {
    fetchUser(user: User): void {
      this.username = user.username;
      this.email = user.email;
    },

    async loginAttempt(user: LoginData): Promise<boolean> {
      try {
        const response = await getHttpClient().post('api/login', {
          email: user.email,
          password: user.password,
        });

        if( response ) {
          this.fetchUser({
            username: user.email,
            email: user.email
          });

          return true;
        }

        return false;

      } catch(e) {
        console.error(e);
        return false
      }
    },

    async registerAttempt(user: RegisterData): Promise<boolean> {
      try {

        const response = await getHttpClient().post('api/register', {
          email: user.email,
          password: user.password,
          username: user.username
        });

        if( response ) {
          await this.loginAttempt({
            email: user.email,
            password: user.password
          })


          return true
        }

        return false
      } catch(e) {
        console.error(e);
        return false
      }
    },

    forceDisconnect(): void {
      this.username = null;
      this.email = null;
      this.jwt = null;
    }
  },
  getters: {
    activeUser: (state) => state.username,
    isLoggedIn: (state): boolean => !!state.username && !!state.email
  },
})
