import DashboardPage from "@backend/pages/DashboardPage.vue";
import CoursesPage from "@backend/pages/CoursesPage.vue";
import CreateCoursePage from "@backend/pages/courses/CreateCoursePage.vue";
import AllCoursesPage from "@backend/pages/courses/AllCoursesPage.vue";

export default [
  { path: '/admin', component: DashboardPage },
  {
    path: '/admin/courses',
    component: CoursesPage ,
    children: [
      { path: 'create', component: CreateCoursePage },
      { path: '', component: AllCoursesPage },
    ]
  },
]
