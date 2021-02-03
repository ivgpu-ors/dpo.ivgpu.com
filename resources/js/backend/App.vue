<template>
  <div class="h-screen w-full">
    <div class="w-72 bg-dark text-light fixed h-screen">
      <user />
      <nav>
        <router-link to="/admin" class="flex items-center h-14 p-4 border-b border-gray-500">
          <img svg-inline src="@svg/icons/dashboard.svg" class="icon mr-2">
          <span>Dashboard</span>
        </router-link>
        <router-link to="/admin/courses" class="flex items-center h-14 p-4">
          <img svg-inline src="@svg/icons/education.svg" class="icon mr-2">
          Courses
        </router-link>
      </nav>
    </div>
    <div class="ml-72 p-2">
      <router-view></router-view>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import useUser from "@backend/hooks/useUser";
import User from "@backend/components/User.vue";

export default defineComponent({
  components: { User },
  setup() {
    const { load: loadUser } = useUser();

    loadUser();
  }
});
</script>
