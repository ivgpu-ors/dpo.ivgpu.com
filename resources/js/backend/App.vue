<template>
  <div class="h-screen w-full">
    <div class="w-72 bg-dark text-light p-2 fixed h-screen">
      <user />
      <nav>
        <router-link to="/admin">Dashboard</router-link>
        <router-link to="/admin/courses">Courses</router-link>
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
