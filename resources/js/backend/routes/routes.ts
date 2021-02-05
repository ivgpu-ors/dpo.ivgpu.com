import DashboardPage from "@backend/pages/DashboardPage.vue";
import CreateCoursePage from "@backend/pages/courses/CreateCoursePage.vue";
import AllCoursesPage from "@backend/pages/courses/AllCoursesPage.vue";
import EmptyRouteView from "@backend/pages/EmptyRouteView.vue";

export default [
  { path: '/admin', component: DashboardPage },
  {
    path: '/admin/courses',
    component: EmptyRouteView ,
    children: [
      { path: 'create', component: CreateCoursePage },
      { path: '', component: AllCoursesPage },
    ]
  },
]
