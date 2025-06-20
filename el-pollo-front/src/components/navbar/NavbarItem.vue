<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  to: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    required: false,
    default:() => null,
  },
  condition: {
    type: Boolean,
    required: false,
    default: () => null,
  },
  isParentExpanded: {
    type: Boolean,
    required: true,
  }
})

const computedListItemProperties = computed(() => {
  const commonProperties = {
    to: props.to,
    rounded: 'lg'
  } as ListItemProperties

  if( null !== props.condition ) {
    commonProperties["v-if"] = props.condition
  }

  return commonProperties
})

interface ListItemProperties {
  to: string
  rounded: string,
  "v-if": boolean,
}

const computedSize = computed(() => {
  return props.isParentExpanded ? 36 : 24
})

</script>

<template>
  <v-list-item
    v-bind="computedListItemProperties"
  >
    <template #prepend>

      <Icon
        v-if="icon"
        :icon="icon"
        :width="computedSize"
        :height="computedSize"
        class="transition-all duration-300 mr-3"
      />

      <v-list-item-title v-if="isParentExpanded">
        {{ title }}
      </v-list-item-title>

    </template>
  </v-list-item>
</template>

<style scoped>

</style>
