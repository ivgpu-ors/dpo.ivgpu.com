<template>
  <label :for="id" class="inline-block mb-2">
    <slot/>
  </label>
  <input :type="type" :id="id" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
         class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none">
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { nanoid } from "nanoid";

export default defineComponent({
  props: {
    type: { type: String, default: 'text' },
    modelValue: { type: String }
  },
  emits: ['update:modelValue'],
  setup() {
    const id = nanoid();

    return {
      id
    }
  }
});
</script>
