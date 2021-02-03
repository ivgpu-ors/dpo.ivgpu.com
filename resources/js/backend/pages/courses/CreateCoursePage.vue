<template>
  <div>
    <h2>Create course</h2>
    <v-input id="name" v-model="name">Название курса</v-input>
    <v-input id="date" v-model="start" type="date">Дата начала</v-input>
    <v-input id="date" v-model="end" type="date">Дата окончания</v-input>
    <v-input id="duration" v-model="duration">Длительность курса</v-input>
    <v-input id="education_time" v-model="education_time">Понадобится для освоения</v-input>
    <v-html v-model="description">О курсе</v-html>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import VInput from "@backend/components/form/VInput.vue";
import VHtml from "@backend/components/form/VHtml.vue";

export default defineComponent({
  components: { VHtml, VInput },
  setup() {
    const name = ref('');
    const start = ref('');
    const end = ref('');
    const duration = ref('');
    const education_time = ref('');
    const description = ref('Description example');

    return {
      name,
      start,
      end,
      duration,
      education_time,
      description
    }
  }
});
</script>
