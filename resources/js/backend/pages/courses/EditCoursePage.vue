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
      <v-input v-model="content_url">
        Ссылка на курс <small v-if="errors.content_url" class="text-red-600">{{ errors.content_url }}</small>
      </v-input>
      <v-file @change="selectImage">Изображение</v-file>
      <img v-if="image" :src="`/storage/${image.file}`" alt="" class="w-full h-48 object-cover mb-3">
      <select-options v-model="options"></select-options>
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
      <hr class="my-6 border-gray-300">
      <select-employee v-model="leader_id">
        Руководитель программы <small v-if="errors.leader_id" class="text-red-600">{{ errors.leader_id }}</small>
      </select-employee>
      <select-employees v-model="teachers_ids">
        Преподаватели курса <small v-if="errors.teachers_ids" class="text-red-600">{{ errors.teachers_ids }}</small>
      </select-employees>

    </div>
  </div>
</template>

<script lang="ts">
import * as dateFormat from 'dateformat';
import { defineComponent, ref, watchEffect } from 'vue';
import { useRoute } from "vue-router";
import useCourse from "@backend/hooks/useCourse";

import VInput from "@backend/components/form/VInput.vue";
import VHtml from "@backend/components/form/VHtml.vue";
import VButton from "@backend/components/form/VButton.vue";
import VInputSelect from "@backend/components/form/VInputSelect.vue";
import SelectEmployee from "@backend/components/SelectEmployee.vue";
import SelectEmployees from "@backend/components/SelectEmployees.vue";
import SelectOptions from "@backend/components/SelectOptions.vue";
import { Option } from "@backend/api/interfaces/Option";
import VFile from "@backend/components/form/VFile.vue";
import { File } from "@backend/api/interfaces/File";

export default defineComponent({
  components: { VFile, SelectEmployees, SelectEmployee, SelectOptions, VInputSelect, VButton, VHtml, VInput },
  setup() {
    const { errors, course, load, update } = useCourse();

    const enabled = ref();
    const name = ref();
    const content_url = ref();
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
    const options = ref<{ option: Option; price: Number; }[]>([]);
    const image = ref<File | undefined>();

    const selectImage = (files: File[]) => {
      console.log(files);
      if (files.length === 1) {
        image.value = files[0];
      }
    }

    const submit = () => {
      update(course.value?.id ?? 0, {
        id: 0,
        enabled: enabled.value,
        name: name.value,
        content_url: content_url.value,
        image_id: image.value?.id,
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
        teachers_ids: teachers_ids.value,
        options: options.value
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

        image.value = course.value.image;
        enabled.value = course.value?.enabled;
        name.value = course.value.name;
        content_url.value = course.value.content_url;
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
        options.value = course.value.options ?? [];
      }
    });

    return {
      name,
      content_url,
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
      errors,
      options,
      image,
      selectImage,
      submit,
    }
  }
});
</script>
