<template>
  <div class="p-3">
    <h1>Courses</h1>
    <v-button route="/admin/courses/create" icon="plus">Add</v-button>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import VButton from "@backend/components/form/VButton.vue";
import useCourse from "@backend/hooks/useCourse";

export default defineComponent({
  components: { VButton },
  setup() {
    const { courses, all } = useCourse();
    all();

    return {
      courses
    }
  }
});
</script>
