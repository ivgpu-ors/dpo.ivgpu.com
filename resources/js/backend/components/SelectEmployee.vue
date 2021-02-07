<template>
  <v-input-select :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
                  v-model:search="employeeInput" :options="employees" id-key="id"
                  value-key="full_name">
    <slot />
  </v-input-select>
</template>

<script lang="ts">
import { defineComponent, ref, watchEffect } from 'vue';

import VInputSelect from "@backend/components/form/VInputSelect.vue";
import useEmployee from "@backend/hooks/useEmployee";

export default defineComponent({
  components: { VInputSelect },

  props: {
    modelValue: { type: Number }
  },

  emits: [ 'update:modelValue' ],

  setup() {
    const employeeInput = ref('');
    const { search, employees } = useEmployee();

    watchEffect(() => {
      search(employeeInput.value);
    });

    return {
      employeeInput,
      employees
    }
  }
});
</script>
