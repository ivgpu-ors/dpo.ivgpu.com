<template>
  <div class="p-3">
    <h1>Courses</h1>
    <div class="mb-3">
      <v-button route="/admin/courses/create" icon="plus">Add</v-button>
    </div>

    <div class="shadow overflow-hidden rounded border-b border-gray-200">
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
        <tr>
          <th class="w-full text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Enabled</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700">
        <tr v-for="course in courses" :key="course.id">
          <td class="w-1/3 text-left py-3 px-4">{{ course.name }}</td>
          <td class="w-1/3 text-left py-3 px-4">
            <button @click="course.enabled = !course.enabled">{{ course.enabled }}</button>
          </td>
          <td class="text-left py-3 px-4">
            <v-button>Edit</v-button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
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
