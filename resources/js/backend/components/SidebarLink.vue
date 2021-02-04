<template>
  <router-link :to="to" class="flex items-center h-14 p-2 md:p-4 border-b border-gray-500 last:border-b-0">
    <div class="w-6 md:mr-2"><slot name="icon" /></div>
    <span class="hidden md:block flex-1"><slot /></span>
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
