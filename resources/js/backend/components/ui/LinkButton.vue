<template>
  <router-link :to="to" class="py-2 px-4 bg-primary text-light rounded-md inline-flex hover:bg-primary-dark items-center">
    <component :is="`icon-${icon}`" class="w-4 mr-3" />
    <slot />
  </router-link>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import IconPlus from "@backend/components/icons/IconPlus.vue";

export default defineComponent({
  components: {
    IconPlus,
  },
  props: {
    to: { type: String, required: true },
    icon: { type: String }
  }
});
</script>
