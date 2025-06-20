<script setup lang="ts">
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  image: {
    type: String,
    required: false,
    default: () => null,
  }
})
</script>

<template>
  <v-card>
    <v-card-title>{{ title }}</v-card-title>

    <template v-if="image">
      <v-divider></v-divider>

      <v-img
        cover
        :src="image"
        max-height="800"
      />
    </template>

    <v-divider></v-divider>

    <slot v-if="$slots" />
  </v-card>
</template>

<style scoped>

</style>
