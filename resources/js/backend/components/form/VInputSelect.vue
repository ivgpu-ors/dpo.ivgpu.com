<template>
  <div class="h-20 w-full relative" @click.stop="">
    <label class="block mb-2" :for="id">
      <slot/>
    </label>

    <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 absolute bg-white z-0"
         :class="{ ring: focus }">
      <input :id="id" type="text" :value="input" @input="$emit('update:input', $event.target.value)" class="w-full"
             @focus="focus = true" ref="searchInput">
      <ul v-if="focus">
        <li v-for="option in options" :key="option[idKey]" :value="option[idKey]"
            class="leading-6 cursor-pointer hover:bg-blue-200"
            @click="select(option[idKey])">
          {{ option[valueKey] }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, onUnmounted, ref } from 'vue';
import { nanoid } from "nanoid";

export default defineComponent({
  props: {
    options: { type: Array, required: true },
    idKey: { type: String, default: 'id' },
    valueKey: { type: String, default: 'value' },
    modelValue: { type: [ Number, String ] },
    input: { type: String },
  },

  emits: ['update:modelValue', 'update:input'],

  setup(props, { emit }) {
    const focus = ref(false);
    const blurFocus = () => focus.value = false;

    onMounted(() => {
      document.addEventListener('click', blurFocus);
    });

    onUnmounted(() => {
      document.removeEventListener('click', blurFocus);
    });

    const searchInput = ref<HTMLInputElement | null>(null);

    const select = (id: number | string) => {
      blurFocus();
      if (searchInput.value) {
        // searchInput.value.value = props.options[id];
      }
      emit('update:modelValue', id);
    }



    return {
      id: nanoid(),
      focus,
      select,
    }
  }
});
</script>
