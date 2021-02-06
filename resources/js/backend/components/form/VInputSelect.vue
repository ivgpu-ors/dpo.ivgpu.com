<template>
  <div class="h-20 w-full relative" @click.stop="">
    <label class="inline-block mb-2" :for="id">
      <slot/>
    </label>

    <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 absolute bg-white z-0"
         :class="{ ring: focus }">
      <input :id="id" type="text" :value="search" @input="$emit('update:search', $event.target.value)" class="w-full"
             @focus="focus = true">
      <ul v-if="focus">
        <li v-for="option in options" :key="option[idKey]" :value="option[idKey]"
            class="leading-6 cursor-pointer hover:bg-blue-200"
            @click="select(option)">
          {{ option[valueKey] }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, onUnmounted, ref, PropType } from 'vue';
import { nanoid } from "nanoid";

type Option = {
  [key: string]: string
}

export default defineComponent({
  props: {
    options: { type: Array as PropType<Option[]>, required: true },
    idKey: { type: String, default: 'id' },
    valueKey: { type: String, default: 'value' },
    modelValue: { type: [ Number, String ] },
    search: { type: String },
  },

  emits: ['update:modelValue', 'update:search'],

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

    const select = (option: Option) => {
      blurFocus();
      emit('update:modelValue', option[props.idKey]);
    }



    return {
      searchInput,
      id: nanoid(),
      focus,
      select,
    }
  }
});
</script>
