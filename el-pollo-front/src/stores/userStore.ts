import { defineStore } from 'pinia'
import type { LoginData, RegisterData, User } from '@/models/user'

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
        /*
        const response = await getHttpClient().post('api/login', {
          email: user.email,
          password: user.password,
        });

         */

        setTimeout(() => {
          this.fetchUser({
            username: user.email,
            email: user.email
          });
        }, (Math.random() * 6000) + 1500)


        return true;
      } catch(e) {
        console.error(e);
        return false
      }
    },

    async registerAttempt(user: RegisterData): Promise<boolean> {
      try {

        /*
        const response = await getHttpClient().post('api/register', {
          email: user.email,
          password: user.password,
          username: user.username
        });

         */

        setTimeout(() => {
          this.loginAttempt({
            email: user.email,
            password: user.password
          })
        }, (Math.random() * 6000) + 1500)

        //if(response) {

        //}
        return true;
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
