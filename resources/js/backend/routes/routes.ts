import DashboardPage from "@backend/pages/DashboardPage.vue";
import CreateCoursePage from "@backend/pages/courses/CreateCoursePage.vue";
import AllCoursesPage from "@backend/pages/courses/AllCoursesPage.vue";
import EmptyRouteView from "@backend/pages/EmptyRouteView.vue";
import EditCoursePage from "@backend/pages/courses/EditCoursePage.vue";
import AllClientsPage from "@backend/pages/clients/AllClientsPage.vue";

export default [
  { path: '/admin', component: DashboardPage },
  {
    path: '/admin/courses',
    component: EmptyRouteView ,
    children: [
      { path: 'create', component: CreateCoursePage },
      { path: ':courseId', component: EditCoursePage },
      { path: '', component: AllCoursesPage },
    ]
  },
  {
    path: '/admin/clients',
    component: EmptyRouteView ,
    children: [
      { path: '', component: AllClientsPage },
    ]
  }
]
