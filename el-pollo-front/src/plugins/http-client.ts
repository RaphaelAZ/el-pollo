import axios, { type AxiosInstance } from 'axios'

const httpClient: AxiosInstance = axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    'Accept': 'application/json'
  },
});

/**
 * Returns the HTTP client.
 */
export const getHttpClient = (): AxiosInstance => httpClient;
