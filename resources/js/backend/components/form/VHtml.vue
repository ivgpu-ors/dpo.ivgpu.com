<template>
  <label class="block mb-2">
    <slot/>
  </label>
  <div class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none">
    <div v-html="modelValue" ref="editorRef"></div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import * as MediumEditor from 'medium-editor';

export default defineComponent({
  props: {
    modelValue: { type: String }
  },
  emits: ['update:modelValue'],
  setup() {
    const editorRef = ref(null);
    let editor = null;

    onMounted(() => {
      editor = new MediumEditor(editorRef.value);
      console.log(editor);
    });

    return {
      editorRef
    }
  }
});
</script>
