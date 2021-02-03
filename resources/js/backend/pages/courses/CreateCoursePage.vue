<template>
  <div>
    <h2>Create course</h2>
    <v-input id="name" v-model="name">Название курса</v-input>
    <v-input id="date" v-model="start" type="date">Дата начала</v-input>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import VInput from "@backend/components/form/VInput.vue";

export default defineComponent({
  components: { VInput },
  setup() {
    const name = ref('');
    const start = ref('');

    return {
      name,
      start
    }
  }
});
</script>
