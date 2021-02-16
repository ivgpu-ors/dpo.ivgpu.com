<template>
  <label :for="id" class="inline-block mb-2">
    <slot/>
  </label>
  <div v-if="loading" class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none">Loading...</div>
  <input v-else type="file" :id="id" @change="selectFile"
         class="mb-4 border border-gray-400 shadow block w-full rounded p-1 focus:ring focus:outline-none">
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { nanoid } from "nanoid";
import { imageApi } from "@backend/api/ImageApi";
import { File } from "@backend/api/interfaces/File";

export default defineComponent({
  props: {
    type: { type: String, default: 'text' },
  },
  emits: ['change'],
  setup(props, { emit }) {
    const id = nanoid();
    const loading = ref(false);

    const selectFile = (e: InputEvent) => {
      const input = e.target as HTMLInputElement;
      if (input.files) {
        loading.value = true;

        imageApi.upload(input.files).then((files: File[]) => {
          emit('change', files);
          loading.value = false;
        }).catch(() => {
          loading.value = false;
        });

      }
    }

    return {
      id,
      loading,
      selectFile
    }
  }
});
</script>
