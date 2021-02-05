<template>
  <div>
    <div class="sticky top-0 bg-white p-3 shadow-lg mb-4 flex z-30">
      <v-button icon="save" @click="submit" class="ml-auto">Save</v-button>
    </div>
    <div class="p-3">
      <h2>Create course</h2>
      <v-input id="name" v-model="name">Название курса</v-input>
      <v-input-select v-model="leader_id" v-model:input="employeeInput" :options="employees" id-key="id"
                      value-key="full_name">
        Руководитель программы
      </v-input-select>
      <v-input id="date" v-model="start" type="date">Дата начала</v-input>
      <v-input id="date" v-model="end" type="date">Дата окончания</v-input>
      <v-input id="duration" v-model="duration">Длительность курса</v-input>
      <v-input id="education_time" v-model="education_time">Понадобится для освоения</v-input>
      <v-html v-model="description">О курсе</v-html>
      <v-html v-model="program">Программа курса</v-html>
      <v-html v-model="conditions">Дополнительные технические условия, необходимые для прохождения программы</v-html>
      <v-html v-model="target_audience">Целевая аудитория</v-html>
      <v-input id="impl_form" v-model="impl_form">Форма реализации</v-input>

    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, watchEffect } from 'vue';
import VInput from "@backend/components/form/VInput.vue";
import VHtml from "@backend/components/form/VHtml.vue";
import VButton from "@backend/components/form/VButton.vue";
import useEmployee from '@backend/hooks/useEmployee';
import VInputSelect from "@backend/components/form/VInputSelect.vue";

export default defineComponent({
  components: { VInputSelect, VButton, VHtml, VInput },
  setup() {
    const name = ref('');
    const start = ref('');
    const end = ref('');
    const duration = ref('');
    const education_time = ref('');
    const description = ref('');
    const program = ref('');
    const conditions = ref('');
    const target_audience = ref('');
    const impl_form = ref('');
    const leader_id = ref(-1);

    const employeeInput = ref('');
    const { search, employees } = useEmployee();

    watchEffect(() => {
      search(employeeInput.value);
    });

    const submit = () => {
      alert(1);
    }

    return {
      employeeInput,
      employees,
      leader_id,
      name,
      start,
      end,
      duration,
      education_time,
      description,
      program,
      conditions,
      target_audience,
      impl_form,
      submit
    }
  }
});
</script>
