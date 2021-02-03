import DashboardPage from "@backend/pages/DashboardPage.vue";
import CoursesPage from "@backend/pages/courses/CoursesPage.vue";

export default [
  { path: '/admin', component: DashboardPage },
  { path: '/admin/courses', component: CoursesPage }
]
