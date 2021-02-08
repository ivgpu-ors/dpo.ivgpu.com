import { Course, CourseView } from "@backend/api/interfaces/Course";
import { ref } from "vue";
import { courseApi } from "@backend/api/CourseApi";

export default function useCourse() {
  const loading = ref(false);
  const courses = ref<CourseView[]>([]);
  const course = ref<Course | undefined>();
  const errors = ref([]);

  async function all() {
    loading.value = true;
    courses.value = await courseApi.all();
    loading.value = false;
  }

  async function create(data: Course) {
    loading.value = true;

    try {
      course.value = await courseApi.create(data)
      errors.value = [];
    } catch (e) {
      errors.value = e.response?.data?.errors;
    } finally {
      loading.value = false;
    }
  }

  async function update(id: Number, data: Course) {
    loading.value = true;

    try {
      course.value = await courseApi.update(id, data)
      errors.value = [];
    } catch (e) {
      errors.value = e.response?.data?.errors;
    } finally {
      loading.value = false;
    }
  }

  async function load(id: Number) {
    loading.value = true;

    try {
      course.value = await courseApi.load(id)
      errors.value = [];
    } catch (e) {
      errors.value = e.response?.data?.errors;
    } finally {
      loading.value = false;
    }
  }

  return {
    loading,
    errors,
    course,
    courses,
    create,
    all,
    load,
    update,
  }
}
