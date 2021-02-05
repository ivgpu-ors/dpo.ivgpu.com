<template>
  <label class="block" :for="id"><slot /></label>
  <div class="block">
    <input :id="id" type="text" :value="input" @input="$emit('update:input', $event.target.value)">
    <select @input="$emit('update:modelValue', $event.target.value)">
      <option v-for="option in options" :key="option[idKey]" :value="option[idKey]">
        {{ option[valueKey] }}
      </option>
    </select>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { nanoid } from "nanoid";

export default defineComponent({
  props: {
    options: { type: Array, required: true },
    idKey: { type: String, default: 'id' },
    valueKey: { type: String, default: 'value' },
    modelValue: { type: String },
    input: { type: String },
  },
  emits: ['update:modelValue', 'update:input'],
  setup() {
    return {
      id: nanoid(),
    }
  }
});
</script>
