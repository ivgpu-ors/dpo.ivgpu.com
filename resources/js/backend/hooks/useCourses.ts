import { Course, CreateCourse } from "@backend/api/interfaces/Course";
import { ref } from "vue";
import { courseApi } from "@backend/api/CourseApi";

export default function useCourse() {
  const loading = ref(false);
  const created = ref<Course | undefined>();
  const errors = ref([]);

  async function create(data: CreateCourse) {
    loading.value = true;

    try {
      created.value = await courseApi.create(data)
      errors.value = [];
    } catch (e) {
      errors.value = e.response?.data?.errors;
    } finally {
      loading.value = false;
    }
  }

  return {
    loading,
    created,
    errors,
    create,
  }
}
