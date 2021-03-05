<template>
  <label class="inline-block mb-2">
    <slot/>
  </label>
  <div ref="editorRef"
       class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none bg-white">
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watchEffect } from 'vue';
import * as MediumEditor from 'medium-editor';

export default defineComponent({
  props: {
    modelValue: { type: String, default: '' },
    placeholder: { type: String, default: 'Введите текст' }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const editorRef = ref<HTMLElement | null>(null);

    const initEditor = (el: HTMLElement) => {
      const editor = new MediumEditor(el, {
        placeholder: false,
        toolbar: {
          buttons: [
            'h2',
            'anchor',
            'bold',
            'italic',
            'justifyLeft',
            'justifyCenter',
            'justifyRight',
            'unorderedlist',
            'orderedlist',
          ]
        }
      });

      editor.subscribe('editableInput', () => {
        emit('update:modelValue', editorRef.value?.innerHTML);
      });
    };

    onMounted(() => {
      if (editorRef?.value) {
        editorRef.value.innerHTML = props.modelValue;
        initEditor(editorRef.value);
      }
    });

    watchEffect(() => {
      if (editorRef?.value && props.modelValue !== editorRef.value.innerHTML) {
        editorRef.value.innerHTML = props.modelValue;
      }
    });

    return {
      editorRef
    }
  }
});
</script>
