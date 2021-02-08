<template>
  <div>
    <div class="sticky top-0 bg-white p-3 shadow-lg mb-4 flex z-10">
      <v-button icon="save" @click="submit" class="ml-auto">Save</v-button>
    </div>
    <div class="p-3">
      <h2>Create course</h2>
      <v-input v-model="name">
        Название курса <small v-if="errors.name" class="text-red-600">{{ errors.name }}</small>
      </v-input>
      <select-employee v-model="leader_id">
        Руководитель программы <small v-if="errors.leader_id" class="text-red-600">{{ errors.leader_id }}</small>
      </select-employee>
      <select-employees v-model="teachers_ids">
        Преподаватели курса <small v-if="errors.teachers_ids" class="text-red-600">{{ errors.teachers_ids }}</small>
      </select-employees>
      <v-input v-model="start" type="date">
        Дата начала <small v-if="errors.start" class="text-red-600">{{ errors.start }}</small>
      </v-input>
      <v-input v-model="end" type="date">
        Дата окончания <small v-if="errors.end" class="text-red-600">{{ errors.end }}</small>
      </v-input>
      <v-input v-model="duration">
        Длительность курса <small v-if="errors.duration" class="text-red-600">{{ errors.duration }}</small>
      </v-input>
      <v-input v-model="education_time">
        Понадобится для освоения <small v-if="errors.education_time" class="text-red-600">{{ errors.education_time }}</small>
      </v-input>
      <v-html v-model="description">
        О курсе <small v-if="errors.description" class="text-red-600">{{ errors.description }}</small>
      </v-html>
      <v-html v-model="program">
        Программа курса <small v-if="errors.program" class="text-red-600">{{ errors.program }}</small>
      </v-html>
      <v-html v-model="conditions">
        Дополнительные технические условия, необходимые для прохождения программы
        <small v-if="errors.conditions" class="text-red-600">{{ errors.conditions }}</small>
      </v-html>
      <v-html v-model="target_audience">
        Целевая аудитория <small v-if="errors.target_audience" class="text-red-600">{{ errors.target_audience }}</small>
      </v-html>
      <v-input v-model="impl_form">
        Форма реализации <small v-if="errors.impl_form" class="text-red-600">{{ errors.impl_form }}</small>
      </v-input>

    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, watchEffect } from 'vue';
import * as dateFormat from 'dateformat';

import VInput from "@backend/components/form/VInput.vue";
import VHtml from "@backend/components/form/VHtml.vue";
import VButton from "@backend/components/form/VButton.vue";
import VInputSelect from "@backend/components/form/VInputSelect.vue";
import SelectEmployee from "@backend/components/SelectEmployee.vue";
import SelectEmployees from "@backend/components/SelectEmployees.vue";
import useCourse from "@backend/hooks/useCourse";
import { useRoute } from "vue-router";

export default defineComponent({
  components: { SelectEmployees, SelectEmployee, VInputSelect, VButton, VHtml, VInput },
  setup() {
    const { errors, course, load, update } = useCourse();

    const enabled = ref();
    const name = ref();
    const start = ref();
    const end = ref();
    const duration = ref();
    const education_time = ref();
    const description = ref();
    const program = ref();
    const conditions = ref();
    const target_audience = ref();
    const impl_form = ref();
    const leader_id = ref();
    const teachers_ids = ref<Number[]>([]);

    const submit = () => {
      update(course.value?.id ?? 0, {
        id: 0,
        enabled: enabled.value,
        name: name.value,
        start: new Date(start.value),
        end: new Date(end.value),
        duration: duration.value,
        education_time: education_time.value,
        description: description.value,
        program: program.value,
        conditions: conditions.value,
        target_audience: target_audience.value,
        impl_form: impl_form.value,
        leader_id: leader_id.value,
        teachers_ids: teachers_ids.value
      });
    }

    const route = useRoute();
    if (typeof route.params.courseId === 'string') {
      load(parseInt(route.params.courseId));
    }

    watchEffect(() => {
      if (course.value) {
        const startDate = course.value.start ? dateFormat(new Date(course.value.start), 'yyyy-mm-dd') : undefined;
        const endDate = course.value.end ? dateFormat(new Date(course.value.end), 'yyyy-mm-dd') : undefined;

        enabled.value = course.value?.enabled;
        name.value = course.value.name;
        start.value = startDate;
        end.value = endDate;
        duration.value = course.value.duration;
        education_time.value = course.value.education_time;
        description.value = course.value.description;
        program.value = course.value.program;
        conditions.value = course.value.conditions;
        target_audience.value = course.value.target_audience;
        impl_form.value = course.value.impl_form;
        leader_id.value = course.value.leader_id;
        teachers_ids.value = course.value.teachers_ids;
      }
    });

    return {
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
      leader_id,
      teachers_ids,
      submit,

      errors,
    }
  }
});
</script>
