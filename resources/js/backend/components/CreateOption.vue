<template>
  <button class="flex p-4 rounded border-2 border-dashed border-gray-400 items-center justify-center hover:bg-gray-200" @click="addModal = true">
    <icon icon="plus" class="h-4 text-gray-400"></icon>
  </button>

  <div class="fixed flex items-start justify-center left-0 top-0 w-screen h-screen bg-white bg-opacity-80 z-40"
       v-if="addModal">
    <div class="p-4 transform lg:mt-32 shadow-lg bg-gray-50 rounded-lg lg:w-1/4">
      <v-input-select v-if="!viewCreate" v-model="existId" :options="options" id-key="id" value-key="name" @add="addNew">
        Выбрать опцию
      </v-input-select>

      <div v-else @keydown="keyHandler">
        <v-input v-model="option.name">Название</v-input>
        <v-input v-model="option.caption">Подпись</v-input>
        <div>Возможности:</div>
        <ul class="mb-3 list-disc list-inside">
          <li v-for="capacity in option.capacities">{{ capacity }}</li>
        </ul>
        <div class="flex items-start">
          <v-input v-model="newCapacity" @keypress="capacityInputPress" />
        </div>
      </div>

      <div class="flex items-center">
        <v-button icon="plus" @click="addSubmit">Добавить</v-button>
        <v-button @click="cancel" class="ml-auto">Отмена</v-button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, reactive } from 'vue';
import Icon from "@backend/components/icons/Icon.vue";
import { Option } from "@backend/api/interfaces/Option";
import VInput from "@backend/components/form/VInput.vue";
import VButton from "@backend/components/form/VButton.vue";
import useOption from "@backend/hooks/useOption";
import VInputSelect from "@backend/components/form/VInputSelect.vue";

export default defineComponent({
  components: { VInputSelect, VButton, VInput, Icon },
  emits: [ 'create', 'cancel' ],
  setup(props, { emit }) {
    const addModal = ref(false);
    const option = reactive<Option>({ capacities: [], caption: "", id: 0, name: "" });
    const existId = ref<Number>();
    const newCapacity = ref('');
    const viewCreate = ref(false);

    const { options, loadOptions, createOption } = useOption();

    const addNew = () => {
      viewCreate.value = true;
    }

    const addSubmit = () => {
      if (viewCreate.value) {
        createOption(option).then((data?: Option) => data && emit('create', data));
      } else if (existId.value) {
        const newOption = options.value.find(o => o.id === existId.value);
        emit('create', newOption);
      }

      addModal.value = false;
    }

    const cancel = () => {
      addModal.value = false;
    };

    const addCapacity = () => {
      if (newCapacity.value && option.capacities) {
        option.capacities.push(newCapacity.value);
        newCapacity.value = '';
      }
    }

    const capacityInputPress = (e: KeyboardEvent) => {
      if (e.key === 'Enter') {
        addCapacity();
      }
    }

    const keyHandler = (event: KeyboardEvent) => {
      if (event.key === 'Escape') {
        addModal.value = false;
      }
    }

    loadOptions();

    return {
      addModal,
      option,
      newCapacity,
      existId,
      options,
      viewCreate,
      addSubmit,
      keyHandler,
      capacityInputPress,
      addNew,
      cancel,
    }
  }
});
</script>
