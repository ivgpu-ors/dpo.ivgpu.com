<template>
  <div class="font-semibold ">Options</div>
  <div class="grid grid-cols-1 lg:grid-cols-5 gap-2">
    <div v-for="option in modelValue" class="shadow-lg bg-white border-gray-500 rounded-md overflow-hidden">
      <div class="bg-jasmine p-3">
        {{ option.option.name }}
      </div>
      {{ option }}
    </div>
    <create-option @create="optionCreate" />
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Option } from "@backend/api/interfaces/Option";
import CreateOption from "@backend/components/CreateOption.vue";

interface CourseOption {
  option: Option;
  price: Number;
}

export default defineComponent({
  components: { CreateOption },
  props: {
    modelValue: { type: Array as PropType<CourseOption[]>, default: [] },
  },
  emits: [ 'update:modelValue' ],
  setup(props, { emit }) {
    const optionCreate = (option: Option) => {
      const newOptions = [...props.modelValue];
      newOptions.push({ option: option, price: 10.0 });

      emit('update:modelValue', newOptions);
    }

    return {
      optionCreate
    }
  }
});
</script>
