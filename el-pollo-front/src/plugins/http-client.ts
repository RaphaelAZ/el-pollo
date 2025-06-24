import axios, { type AxiosInstance } from 'axios'
import { useUserStore } from '@/stores/userStore.ts'

const httpClient: AxiosInstance = axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    'Accept': 'application/json'
  },
});

httpClient.interceptors.request.use((config) => {
  const userStore = useUserStore()

  if( userStore.isLoggedIn ) {
    //set the token in the request
    config.headers.Authorization = `Bearer ${userStore.jwt}`
  }

  return config
})


/**
 * Returns the HTTP client.
 */
export const getHttpClient = (): AxiosInstance => httpClient;
