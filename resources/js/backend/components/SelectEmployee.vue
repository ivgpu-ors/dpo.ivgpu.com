<template>
  <div class="fixed flex items-start justify-center left-0 top-0 w-screen h-screen bg-white bg-opacity-80 z-40"
       v-if="addModal">
    <div class="p-4 transform lg:translate-y-48 shadow-lg bg-gray-50 rounded-lg lg:w-1/4">
      <form @submit.prevent="addSubmit" @keydown="keyHandler">
        <v-input v-model="addEmployeeFullName">
          ФИО сотрудника
          <small v-if="errors.full_name" class="text-red-600">{{ errors.full_name[0] }}</small>
        </v-input>

        <v-input v-model="addEmployeePost">
          Должность сотрудника
          <small v-if="errors.post" class="text-red-600">{{ errors.post[0] }}</small>
        </v-input>

        <v-button icon="plus">Добавить</v-button>
      </form>
    </div>
  </div>

  <v-input-select :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
                  :search="employeeInput" @update:search="updateSearch" :options="employees" @add="addHandler"
                  id-key="id" value-key="full_name">
    <slot/>
  </v-input-select>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref, watchEffect } from 'vue';

import useEmployee from "@backend/hooks/useEmployee";

import VInputSelect from "@backend/components/form/VInputSelect.vue";
import VInput from "@backend/components/form/VInput.vue";
import VButton from "@backend/components/form/VButton.vue";
import useDebounceSearch from "@backend/hooks/useDebounceSearch";

export default defineComponent({
  components: { VButton, VInput, VInputSelect },

  props: {
    modelValue: { type: Number }
  },

  emits: ['update:modelValue'],

  setup(props, { emit }) {
    const { search, employees, create, errors, get } = useEmployee();
    const {
      displayValue: employeeInput,
      debounceListener: updateSearch
    } = useDebounceSearch((val: string) => search(val));

    onMounted(() => search(''));

    watchEffect(() => {
      if (props.modelValue) {
        get([props.modelValue]);
      }
    });

    const addModal = ref(false);

    const addHandler = () => {
      addModal.value = true;
    }

    const keyHandler = (event: KeyboardEvent) => {
      if (event.key === 'Escape') {
        addModal.value = false;
      }
    }

    const addEmployeeFullName = ref('');
    const addEmployeePost = ref('');
    const addSubmit = () => {
      create({ full_name: addEmployeeFullName.value, post: addEmployeePost.value })
        .then(data => {
          if (data) {
            addModal.value = false;
            emit('update:modelValue', data.id)
          }
        });
    }

    return {
      employeeInput,
      employees,
      addModal,
      addEmployeeFullName,
      addEmployeePost,
      errors,
      addHandler,
      keyHandler,
      addSubmit,
      updateSearch
    }
  }
});
</script>
