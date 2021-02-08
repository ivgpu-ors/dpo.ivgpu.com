<template>
  <div class="inline-flex bg-gray-100 shadow-inner rounded-full h-6 p-1 w-10 cursor-pointer items-center"
       :class="switcherClass"
       @click="$emit('update:modelValue', !modelValue)">
    <div class="w-4 h-4 border-2 border-gray-500 rounded-full bg-white" :class="switcherInnerClass"></div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from 'vue';

export default defineComponent({
  props: {
    modelValue: { type: Boolean }
  },
  emits: [ 'update:modelValue' ],
  setup(props) {
    const switcherClass = computed(() => props.modelValue ? 'bg-green-500' : 'bg-red-500');
    const switcherInnerClass = computed(() => props.modelValue ? 'ml-auto' : 'ml-0');

    return {
      switcherClass,
      switcherInnerClass
    }
  }
});
</script>
