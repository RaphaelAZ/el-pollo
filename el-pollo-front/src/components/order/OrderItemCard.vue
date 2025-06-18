<script setup lang="ts">
import { computed, type PropType, ref } from 'vue'
import { type Burger, type Consumable, ConsumableType, type Drink } from '@/models/consumable'

const props = defineProps({
  item: {
    type: Object as PropType<Drink | Burger | Consumable>,
    required: true,
  },
  type: {
    type: Object as PropType<ConsumableType>,
    required: true,
  },
  descriptionStopAt: {
    type: Number,
    required: false,
    default: () => 125
  }
})

/**
 * Computes the burger description to be displayed
 */
const computedBurgerDescription = computed(() => {
  const itemDescription: string|undefined = props.item.description

  if( !itemDescription ) {
    return ''
  }

  //slice the description not to be too long
  const slicedDescription: string = itemDescription.slice(0, props.descriptionStopAt)

  if( slicedDescription !== itemDescription ) {
    isDescriptionOverFlow.value = true
    return `${slicedDescription}...`
  }

  return itemDescription;
})

/** If the burger description overflows */
const isDescriptionOverFlow = ref<boolean>(false)

const originalItemQuantity: number = props.item.quantity ?? 0
</script>

<template>
  <v-card class="bg-info rounded-md d-flex flex-column">
    <v-img v-if="item.image" height="200" :src="item.image" cover />

    <v-card-title>
      {{ item.name }}
    </v-card-title>

    <v-card-text class="d-flex flex-row align-end">
      <p>
        <v-tooltip
          :text="item.description"
          v-if="isDescriptionOverFlow"
          location="bottom"
          class="custom-tooltip"
          max-width="200"
        >
          <template v-slot:activator="{ props: activatorProps }">
            <Icon
              icon="mdi:info"
              v-bind="activatorProps"
              width="20"
              color="success"
            />
          </template>
        </v-tooltip>
        {{ computedBurgerDescription }}
      </p>
    </v-card-text>

    <v-divider class="mx-4 mb-1"></v-divider>

    <div
      v-if="type === ConsumableType.Burger"
      class="d-flex flex-wrap gap-2 chips-container ma-2"
    >
      <v-chip
        v-for="(ingredient, key) in (item as Burger).ingredients"
        :key="key"
        density="compact"
        class="mb-1"
      >
        {{ ingredient }}
      </v-chip>
    </div>

    <div v-else-if="type === ConsumableType.Drink">

    </div>

    <v-card-actions>
      <v-btn block border>
        <Icon icon="material-symbols:delete" />
        Supprimer
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>
.chips-container {
  max-height: 3.5em;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
