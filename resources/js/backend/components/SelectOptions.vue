<template>
  <div class="font-semibold ">Options</div>
  <div class="grid grid-cols-1 lg:grid-cols-5 gap-2">
    <div v-for="option in modelValue" class="shadow-lg bg-white border-gray-500 rounded-md overflow-hidden flex flex-col">
      <div class="bg-gray-700 p-3 text-light">
        {{ option.option.name }}
      </div>

      <div class="flex-grow">
        <ul class="list-inside list-disc p-3" v-if="option.option.capacities.length">
          <li v-for="capacity in option.option.capacities">{{ capacity }}</li>
        </ul>
        <div v-if="option.option.caption" class="border-t border-gray-300 p-3">
          {{ option.option.caption }}
        </div>
      </div>

      <div class="bg-gray-700 p-3 flex">
        <input type="text" class="bg-white rounded-tl rounded-bl border border-light focus:ring min-w-0" v-model="option.price">
        <div class="bg-gray-100 px-2 border-l border-gray-300 rounded-tr rounded-br">руб</div>
      </div>

      <button class="bg-red-500 text-light py-2" @click="deleteOption(option.option)">Удалить</button>
    </div>
    <create-option @create="createOption" />
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Option } from "@backend/api/interfaces/Option";
import CreateOption from "@backend/components/CreateOption.vue";
import VInput from "@backend/components/form/VInput.vue";

interface CourseOption {
  option: Option;
  price: Number;
}

export default defineComponent({
  components: { VInput, CreateOption },
  props: {
    modelValue: { type: Array as PropType<CourseOption[]>, default: [] },
  },
  emits: [ 'update:modelValue' ],
  setup(props, { emit }) {
    const createOption = (option: Option) => {
      const newOptions = [...props.modelValue];
      newOptions.push({ option: option, price: 0.0 });

      emit('update:modelValue', newOptions);
    }

    const deleteOption = (option: Option) => {
      const newOptions = props.modelValue.filter(o => o.option.id !== option.id)
      emit('update:modelValue', newOptions);
    }

    return {
      createOption,
      deleteOption
    }
  }
});
</script>
