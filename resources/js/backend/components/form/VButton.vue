<template>
  <router-link v-if="route" :to="route" class="py-2 px-4 bg-primary text-light rounded-md inline-flex hover:bg-primary-dark items-center">
    <icon :icon="icon" class="w-4 mr-3" />
    <slot />
  </router-link>
  <button v-else class="py-2 px-4 bg-primary text-light rounded-md inline-flex hover:bg-primary-dark items-center">
    <icon :icon="icon" class="w-4 mr-3" />
    <slot />
  </button>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Icon from "@backend/components/icons/Icon.vue";

export default defineComponent({
  components: {
    Icon,
  },
  props: {
    route: { type: String },
    icon: { type: String }
  }
});
</script>
