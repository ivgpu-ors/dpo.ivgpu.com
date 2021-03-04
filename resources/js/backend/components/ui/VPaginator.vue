<template>
  <ul class="shadow-md rounded ring-1 ring-gray-200 overflow-hidden flex divide-x divide-gray-200">
    <li v-for="page in pages" :key="page" class="w-8 h-8 flex items-center justify-center cursor-pointer"
        :class="{ 'bg-blue-200': (page === current) }" @click="$emit('goto', page)">
      <span>{{ page }}</span>
    </li>
  </ul>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    pages: { type: Number, required: true },
    current: { type: Number, required: true },
  },

  emits: [ 'goto' ],
});
</script>
