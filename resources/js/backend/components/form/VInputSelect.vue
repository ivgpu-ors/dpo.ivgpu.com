<template>
  <div class="h-20 w-full relative" @click.stop="">
    <label class="inline-block mb-2" :for="id">
      <slot/>
    </label>

    <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 absolute bg-white z-0"
         :class="{ ring: focus }">
      <label :for="id" v-if="selected" v-show="!focus" class="absolute">{{ selected[valueKey] }}</label>
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
    modelValue: { type: [ Number, String ], required: true },
    search: { type: String },
  },

  emits: ['update:modelValue', 'update:search'],

  setup(props, { emit }) {
    const id = nanoid();
    const focus = ref(false);
    const selected = ref<Option | undefined>(props.options.find(o => o[props.idKey] === props.modelValue));

    const blurFocus = () => focus.value = false;

    const select = (option: Option) => {
      blurFocus();
      selected.value = option;
      emit('update:modelValue', option[props.idKey]);
    }

    onMounted(() => {
      document.addEventListener('click', blurFocus);
    });

    onUnmounted(() => {
      document.removeEventListener('click', blurFocus);
    });

    return {
      id,
      focus,
      selected,
      select,
    }
  }
});
</script>
