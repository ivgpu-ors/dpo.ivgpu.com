<template>
  <div class="h-20 w-full relative" @click.stop="">
    <label class="inline-block mb-2" :for="id">
      <slot/>
    </label>

    <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 absolute bg-white z-0 focus:outline-none"
         :class="{ ring: focus, 'z-10': focus }" tabindex="0" @focus="setFocus" @blur="focus = false" @keydown="keyPressHandler">

      <label :for="id" v-if="selected" v-show="!focus" class="absolute">{{ selected[valueKey] }}</label>

      <input :id="id" type="text" :value="search" @input="$emit('update:search', $event.target.value)"
             class="w-full focus:outline-none" tabindex="-1" @focus="focus = true" ref="inputRef">

      <ul v-if="focus">
        <li v-for="option in options" :key="option[idKey]"
            class="leading-6 cursor-pointer" :class="{ 'bg-blue-200': hover === option[idKey] }" @click="select(option[idKey])" @mouseover="hoverOn(option[idKey])">
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
import { defineComponent, onMounted, onUnmounted, ref, PropType, computed } from 'vue';
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
    const inputRef = ref<HTMLInputElement | null>(null);

    const blurFocus = () => {
      focus.value = false;
      if (inputRef.value) {
        inputRef.value.blur();
      }
    }

    const setFocus = () => {
      focus.value = true;
      if (inputRef.value) {
        inputRef.value.focus();
      }
    }

    const select = (id: String) => {
      blurFocus();
      emit('update:modelValue', id);
    }

    const addElement = () => {
      emit('add');
    }

    const hover = ref<String | null>(null);

    const hoverOn = (id: String) => {
      hover.value = id;
    }

    const hoverNext = () => {
      const currentId = hover.value ? props.options.findIndex(o => o[props.idKey] === hover.value) : -1;
      const nextOption = props.options[currentId + 1] ?? props.options[0];

      hover.value = nextOption ? nextOption[props.idKey] : null;
    }

    const hoverPrev = () => {
      const currentId = hover.value ? props.options.findIndex(o => o[props.idKey] === hover.value) : props.options.length;
      const prevOption = props.options[currentId - 1];

      hover.value = prevOption ? prevOption[props.idKey] : null;
    }

    const keyPressHandler = (event: KeyboardEvent) => {
      if (event.key === 'Tab' || event.key === 'Escape') {
        blurFocus();
      } else if (event.key === 'ArrowDown') {
        hoverNext();
      } else if (event.key === 'ArrowUp') {
        hoverPrev();
      } else if (event.key === 'Enter' && event.ctrlKey) {
        addElement();
      } else if (event.key === 'Enter' && hover.value) {
        select(hover.value);
      }
    }

    const selected = computed(() => props.options.find(o => o[props.idKey] === props.modelValue));

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
      hover,
      select,
      setFocus,
      keyPressHandler,
      addElement,
      hoverOn,
    }
  }
});
</script>
