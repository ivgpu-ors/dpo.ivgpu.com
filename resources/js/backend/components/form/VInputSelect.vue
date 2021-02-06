<template>
  <div class="h-20 w-full relative" @click.stop="">
    <label class="inline-block mb-2" :for="id">
      <slot/>
    </label>

    <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 absolute bg-white z-0 focus:outline-none"
         :class="{ ring: focus }" tabindex="0" @focus="setFocusToInput" @blur="focus = false" @keydown="keyPressHandler">

      <label :for="id" v-if="selected" v-show="!focus" class="absolute">{{ selected[valueKey] }}</label>

      <input :id="id" type="text" :value="search" @input="$emit('update:search', $event.target.value)"
             class="w-full focus:outline-none" tabindex="-1" @focus="focus = true" ref="inputRef">

      <ul v-if="focus">
        <li v-for="option in options" :key="option[idKey]" :value="option[idKey]"
            class="leading-6 cursor-pointer hover:bg-blue-200" @click="select(option)">
          {{ option[valueKey] }}
        </li>
        <li class="flex h-12 items-center border-t border-gray-200">
          <kbd class="bg-gray-200 rounded-lg px-2">Ctrl + Enter</kbd>
          <button class="italic hover:underline ml-2" tabindex="-1" @click="addElement">Добавить элемент</button>
        </li>
      </ul>

    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, onUnmounted, ref, PropType } from 'vue';
import { nanoid } from "nanoid";
import VButton from "@backend/components/form/VButton.vue";

type Option = {
  [key: string]: string
}

export default defineComponent({
  components: { VButton },
  props: {
    options: { type: Array as PropType<Option[]>, required: true },
    idKey: { type: String, default: 'id' },
    valueKey: { type: String, default: 'value' },
    modelValue: { type: [Number, String] },
    search: { type: String },
  },

  emits: ['update:modelValue', 'update:search', 'add'],

  setup(props, { emit }) {
    const id = nanoid();
    const focus = ref(false);
    const selected = ref<Option | undefined>(props.options.find(o => o[props.idKey] === props.modelValue));

    const blurFocus = () => {
      focus.value = false;
      if (inputRef.value) {
        inputRef.value.blur();
      }
    }

    const select = (option: Option) => {
      blurFocus();
      selected.value = option;
      emit('update:modelValue', option[props.idKey]);
    }

    const addElement = () => {
      emit('add');
    }

    const inputRef = ref<HTMLInputElement | null>(null);
    const setFocusToInput = () => {
      focus.value = true;
      if (inputRef.value) {
        inputRef.value.focus();
      }
    }

    const keyPressHandler = (event: KeyboardEvent) => {
      if (event.key === 'Tab') {
        blurFocus();
      } else if (event.key === 'Enter' && event.ctrlKey) {
        addElement();
      }
    }

    onMounted(() => {
      document.addEventListener('click', blurFocus);
    });

    onUnmounted(() => {
      document.removeEventListener('click', blurFocus);
    });

    return {
      inputRef,
      id,
      focus,
      selected,
      select,
      setFocusToInput,
      keyPressHandler,
      addElement,
    }
  }
});
</script>
