import { createApp } from 'vue';

import { router } from "@backend/routes";

import App from '@backend/App.vue';

createApp(App)
  .use(router)
  .mount('#app');
