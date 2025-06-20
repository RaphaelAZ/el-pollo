import { createApp } from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import pinia from '@/plugins/pinia.ts'
import router from '@/router'
import { Icon } from '@iconify/vue';

const app = createApp(App);

app.component('Icon', Icon);

app
  .use(vuetify)
  .use(pinia)
  .use(router)
  .mount('#app');