<template>
  <component :is="`icon-${icon}`" />
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import IconPlus from "@backend/components/icons/IconPlus.vue";
import IconSave from "@backend/components/icons/IconSave.vue";

export default defineComponent({
  components: {
    IconPlus, IconSave
  },
  props: {
    icon: { type: String }
  }
});
</script>
