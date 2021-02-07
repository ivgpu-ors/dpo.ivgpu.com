<template>
  <div>
    <div class="sticky top-0 bg-white p-3 shadow-lg mb-4 flex z-30">
      <v-button icon="save" @click="submit" class="ml-auto">Save</v-button>
    </div>
    <div class="p-3">
      <h2>Create course</h2>
      <v-input id="name" v-model="name">Название курса</v-input>
      <select-employee v-model="leader_id">Руководитель программы</select-employee>
      <v-input id="start_date" v-model="start" type="date">Дата начала</v-input>
      <v-input id="end_date" v-model="end" type="date">Дата окончания</v-input>
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
import { defineComponent, ref } from 'vue';
import VInput from "@backend/components/form/VInput.vue";
import VHtml from "@backend/components/form/VHtml.vue";
import VButton from "@backend/components/form/VButton.vue";
import VInputSelect from "@backend/components/form/VInputSelect.vue";
import SelectEmployee from "@backend/components/SelectEmployee.vue";

export default defineComponent({
  components: { SelectEmployee, VInputSelect, VButton, VHtml, VInput },
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

    const submit = () => {
      alert(1);
    }

    return {
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
