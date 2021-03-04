<template>
  <router-link :to="to" class="flex items-center h-14 p-2 border-b border-gray-500 last:border-b-0 text-white">
    <div class="w-6 lg:mr-2"><slot name="icon" /></div>
    <span class="hidden lg:block"><slot /></span>
  </router-link>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    to: { type: String, required: true },
  },
});
</script>
