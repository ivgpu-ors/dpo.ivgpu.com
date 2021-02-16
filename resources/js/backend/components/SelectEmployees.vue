<template>
  <div class="inline-block mb-2">
    <slot/>
  </div>
  <ul>
    <li v-for="employee in employees" class="flex items-center mb-2">
      <span>{{ employee.full_name }}</span>
      <v-button class="ml-4" @click="deleteEmployee(employee.id)">Удалить</v-button>
    </li>
  </ul>
  <div class="flex items-center">
    <select-employee v-model="newEmployeeId"></select-employee>
    <v-button class="ml-3" @click="addEmployee">Добавить</v-button>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType, ref, watchEffect } from 'vue';
import SelectEmployee from "@backend/components/SelectEmployee.vue";
import VButton from "@backend/components/form/VButton.vue";
import useEmployee from "@backend/hooks/useEmployee";

export default defineComponent({
  components: { VButton, SelectEmployee },
  props: {
    modelValue: { type: Array as PropType<Number[]>, default: [] }
  },
  emits: ['update:modelValue'],

  setup(props, { emit }) {
    const newEmployeeId = ref<Number | undefined>();
    const { employees, get } = useEmployee();

    const addEmployee = () => emit('update:modelValue', [...props.modelValue, newEmployeeId.value]);
    const deleteEmployee = (employee_id: Number) => emit('update:modelValue', props.modelValue.filter(eid => eid != employee_id));

    watchEffect(() => get(props.modelValue));

    return {
      newEmployeeId,
      employees,
      addEmployee,
      deleteEmployee
    }
  }
});
</script>
