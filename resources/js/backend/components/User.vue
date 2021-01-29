<template>
  <div v-if="ready" class="flex items-center">
    <img v-if="state.photo" :src="state.photo" alt="User photo" class="w-16 h-16 mr-2 rounded-full">
    <p>{{ state.first_name }} <br> {{ state.last_name }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { useAsyncState } from "@vueuse/core";

import UserApi from "@backend/api/UserApi";
import User from "@backend/api/interfaces/User";

export default defineComponent({
  setup() {
    const api = new UserApi();
    const { state, ready } = useAsyncState<User>(api.getCurrentUser(), {
      id: '',
      last_name: '',
      first_name: '',
      email: '',
      roles: [],
      created_at: new Date(),
      updated_at: new Date(),
    });

    return { state, ready };
  }
});
</script>
