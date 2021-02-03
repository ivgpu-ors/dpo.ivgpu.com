<template>
  <div v-if="ready" class="flex items-center p-2">
    <img v-if="user.photo" :src="user.photo" alt="User photo" class="w-16 h-16 mr-2 rounded-full">
    <p>{{ user.first_name }} <br> {{ user.last_name }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import useUser from "@backend/hooks/useUser";

export default defineComponent({
  setup() {
    const { ready, user } = useUser();

    return { user, ready };
  }
});
</script>
