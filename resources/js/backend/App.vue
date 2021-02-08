<template>
  <div class="h-screen w-full">
    <div class="w-10 overflow-x-hidden lg:w-72 bg-dark text-light fixed h-screen">
      <user />
      <nav>
        <sidebar-link to="/admin">
          <template #icon><img svg-inline src="@svg/icons/dashboard.svg"></template>
          Dashboard
        </sidebar-link>
        <sidebar-link to="/admin/courses">
          <template #icon><img svg-inline src="@svg/icons/education.svg"></template>
          Courses
        </sidebar-link>
      </nav>
    </div>
    <div class="ml-10 lg:ml-72 bg-gray-100">
      <router-view></router-view>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import useUser from "@backend/hooks/useUser";
import User from "@backend/components/User.vue";
import SidebarLink from "@backend/components/SidebarLink.vue";

export default defineComponent({
  components: { SidebarLink, User },
  setup() {
    const { load: loadUser } = useUser();

    loadUser();
  }
});
</script>
