import { computed, ref } from "vue";
import User from "@backend/api/interfaces/User";
import { userApi } from "@backend/api/UserApi";

const user = ref<User>({
  created_at: new Date(),
  email: "",
  first_name: "",
  id: "",
  last_name: "",
  roles: [],
  updated_at: new Date()
});

export default function useUser() {
  const ready = ref(false);

  async function load() {
    ready.value = false;
    user.value = await userApi.getCurrentUser();
    ready.value = true;
  }

  return {
    ready: computed(() => ready.value),
    user: computed(() => user.value),
    load
  }
}
