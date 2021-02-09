import { reactive, ref } from "vue";
import { Option } from "@backend/api/interfaces/Option";
import { optionApi } from "@backend/api/OptionApi";

export default function useOption() {
  const loading = ref(false);
  const options = ref<Option[]>([]);
  const errors = reactive<string[][]>([]);

  async function loadOptions() {
    loading.value = true;
    options.value = await optionApi.all();
    loading.value = false;
  }

  async function createOption(data: Option) {
    loading.value = true;
    errors.length = 0;

    try {
      return await optionApi.create(data);
    } catch (e) {
      errors.push(e.response?.data?.errors);
    } finally {
      loading.value = false;
    }
  }

  return {
    loading,
    options,
    errors,
    createOption,
    loadOptions
  }
}
