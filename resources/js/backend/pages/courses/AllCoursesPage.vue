<template>
  <link-button to="/admin/courses/create" icon="plus">Add</link-button>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import LinkButton from "@backend/components/ui/LinkButton.vue";

export default defineComponent({
  components: { LinkButton }
});
</script>
