<script setup lang="ts">
import { computed, type PropType } from 'vue'
import type { Drink } from '@/models/consumable.ts'

const props = defineProps({
  drink: {
    type: Object as PropType<Drink>,
    required: true
  },
  maxImageHeight: {
    type: Number,
    required: false,
    default: () => 500
  }
})

const emit = defineEmits(['close']);

const closeDialog = (): void => {
  emit('close')
}

const computedAlcoolIcon = computed(() => {
  return props.drink.isAlcoholic ? 'mdi:alcohol' : 'material-symbols:no-drinks'
})

const computedAlcoolText = computed(() => {
  return props.drink.isAlcoholic ? 'Alcoolisée' : 'Non Alcoolisée'
})

const computedAvailableText = computed(() => {
  return props.drink.available
    ? "Disponible"
    : "Non disponible"
})

</script>

<template>
  <v-card>
    <v-img
      v-if="drink.image"
      :src="drink.image"
      cover
      :max-height="maxImageHeight"
    />

    <v-card-title>
      {{ drink.name }}
      <v-chip>{{ drink.price }} €</v-chip>

      <v-chip :color=" props.drink.available ? 'info' : 'error' ">
        {{ computedAvailableText }}
      </v-chip>
    </v-card-title>

    <v-container>
      <v-card-text v-if="drink.description">
        <p>{{ drink.description }}</p>

        <v-divider class="mt-5"></v-divider>
      </v-card-text>

      <v-card-text class="d-flex items-center">
        <Icon :icon="computedAlcoolIcon" />
        <p>{{ computedAlcoolText }}</p>
      </v-card-text>

      <v-card-actions>
        <v-btn
          @click="closeDialog"
        >
          <Icon icon="mdi:close" />
          Fermer
        </v-btn>
      </v-card-actions>
    </v-container>
  </v-card>
</template>

<style scoped>

</style>
