<template>
  <component :is="icon_name" />
</template>

<script lang="ts">
import { computed, defineComponent } from 'vue';
import IconPlus from "@backend/components/icons/IconPlus.vue";
import IconSave from "@backend/components/icons/IconSave.vue";

export default defineComponent({
  components: {
    IconPlus, IconSave
  },
  props: {
    icon: { type: String }
  },

  setup(props) {
    return {
      icon_name: computed(() => 'icon-' + props.icon),
    }
  }
});
</script>
