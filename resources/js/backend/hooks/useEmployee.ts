import { ref } from "vue";
import { employeeApi } from "@backend/api/EmployeeApi";
import { Employee, CreateParams } from "@backend/api/interfaces/Employee";

export default function useUser() {
  const loading = ref(false);
  const employees = ref<Employee[]>([]);
  const errors = ref([]);

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

  async function get(ids: Number[]) {
    loading.value = true;
    employees.value = await employeeApi.byIds(ids);
    loading.value = false;
  }

  async function create(data: CreateParams): Promise<Employee | undefined> {
    loading.value = true;

    try {
      const newEmployee = await employeeApi.create(data);
      employees.value = [newEmployee];

      return newEmployee
    } catch (e) {
      errors.value = e.response?.data?.errors;
    } finally {
      loading.value = false;
    }

  }

  return {
    loading,
    employees,
    errors,
    search,
    all,
    create,
    get,
  }
}
