<template>
  <label :for="id" class="block mb-2">
    <slot/>
  </label>
  <input :type="type" :id="id" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
         class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none">
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    id: { type: String, required: true },
    type: { type: String, default: 'text' },
    modelValue: { type: String }
  },
  emits: ['update:modelValue'],
});
</script>
