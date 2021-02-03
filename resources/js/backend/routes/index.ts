import { createRouter, createWebHistory } from "vue-router";
import routes from "@backend/routes/routes";

export const router = createRouter({
  history: createWebHistory(),
  scrollBehavior: () => ({ top: 0 }),
  routes
});
