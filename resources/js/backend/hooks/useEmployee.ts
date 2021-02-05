import { ref } from "vue";
import { employeeApi } from "@backend/api/EmployeeApi";
import Employee from "@backend/api/interfaces/Employee";

export default function useUser() {
  const loading = ref(false);
  const employees = ref<Employee[]>([]);

  async function all() {
    loading.value = true;
    employees.value = await employeeApi.getAll();
    loading.value = false;
  }

  async function search(search: string) {
    loading.value = true;
    employees.value = await employeeApi.suggest(search);
    loading.value = false;
  }

  return {
    loading,
    search,
    employees,
    all
  }
}
