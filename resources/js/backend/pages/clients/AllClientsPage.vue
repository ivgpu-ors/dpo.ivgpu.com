<template>
  <div class="p-3">
    <h1>Clients</h1>
    <div class="shadow overflow-hidden rounded border-b border-gray-200">
      <v-paginator v-if="pages !== undefined" :pages="pages.last_page" :current="currentPage" @goto="gotoPage" />
      <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
        <tr>
          <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm"></th>
          <th class="w-full text-left py-3 px-4 uppercase font-semibold text-sm">ФИО</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Телефон</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">E-Mail</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Заказы</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">На сумму</th>
        </tr>
        </thead>
        <tbody class="text-gray-700">
        <tr v-if="loading">
          <td colspan="6" class="text-center italic py-3">Loading...</td>
        </tr>
        <tr v-if="clients.length === 0">
          <td colspan="6" class="text-center italic py-3">Нет клиентов</td>
        </tr>
        <tr v-for="client in clients" :key="client.id">
          <td class="w-1/12 text-left py-3 px-4">
            <img :src="client.photo" alt="" class="w-full object-fit h-full">
          </td>
          <td class="text-left py-3 px-4">{{ client.last_name }} {{ client.first_name }} {{ client.middle_name }}</td>
          <td class="text-left py-3 px-4">{{ client.phone }}</td>
          <td class="text-left py-3 px-4"><a :href="`mailto:${client.email}`">{{ client.email }}</a></td>
          <td class="text-left py-3 px-4">{{ client.orders_all }} / {{ client.orders_paid }}</td>
          <td class="text-left py-3 px-4">{{ client.orders_sum }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, ref } from 'vue';
import { clientApi } from "@backend/api/ClientApi";
import { Paginator } from "@backend/api/interfaces/Paginator";
import Client from "@backend/api/interfaces/Client";
import VPaginator from "@backend/components/ui/VPaginator.vue";

export default defineComponent({
  components: { VPaginator },
  setup() {
    const loading = ref<boolean>(false);
    const pages = ref<Paginator<Client>>({
      current_page: 0,
      data: [],
      first_page_url: "",
      from: 0,
      last_page: 0,
      last_page_url: "",
      links: [],
      path: "",
      per_page: 0,
      to: 0,
      total: 0,
    });
    const currentPage = ref<number>(1);

    async function getClients(page = 1) {
      loading.value = true;
      pages.value = await clientApi.getClients(page);
      loading.value = false;
    }

    const gotoPage = (page: number) => getClients(page);

    onMounted(() => getClients());

    return {
      loading,
      pages,
      currentPage,
      clients: computed<Client[]>(() => pages.value?.data ?? []),
      gotoPage
    }
  }
});
</script>
