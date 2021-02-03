import DashboardPage from "@backend/pages/DashboardPage.vue";
import CoursesPage from "@backend/pages/courses/CoursesPage.vue";
import CreateCoursePage from "@backend/pages/courses/CreateCoursePage.vue";

export default [
  { path: '/admin', component: DashboardPage },
  { path: '/admin/courses', component: CoursesPage },
  { path: '/admin/courses/create', component: CreateCoursePage },
]
