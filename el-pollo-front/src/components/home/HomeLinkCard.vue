<script setup lang="ts">
import type { PropType } from 'vue'

defineProps({
  title: {
    type: String,
    required: true,
  },
  carousel: {
    type: Array as PropType<string[]>,
    required: false,
  },
  image: {
    type: String,
    required: false,
  }
})

</script>

<template>
  <v-card>
    <v-card-title>{{ title }}</v-card-title>

    <template v-if="image || (carousel && carousel.length > 0)">
      <v-divider></v-divider>

      <v-carousel
        cycle
        hide-delimiter-background
        hide-delimiters
        :show-arrows="false"
        v-if="(carousel && carousel.length > 0)"
      >
        <v-carousel-item
          v-for="(singleImage, key) in carousel"
          :key="key"
          :src="singleImage"
          cover
        />
      </v-carousel>

      <v-img
        v-else
        :src="image"
        cover
      />
    </template>

    <v-divider></v-divider>

    <slot v-if="$slots" />
  </v-card>
</template>

<style scoped>

</style>
