<script setup lang="ts">
//This component displays a dialog that take the whole container to display a loading

const props = defineProps({
  visible: {
    type: Boolean,
    required: false,
    default: () => false,
  },
  size: {
    type: Number,
    required: false,
    default: () => 100
  },
  text: {
    type: String,
    required: false,
    default: () => 'Chargement...'
  }
})
</script>

<template>
  <v-dialog
    :model-value="props.visible"
    class="absolute top-0 left-0 w-full h-full"
    persistent
  >

    <!-- Container for loading -->
    <div
      v-if="!$slots.default"
      class="op-80 d-flex items-center justify-center pa-6"
    >
      <div class="d-flex flex-column gap-6 justify-center align-center w-full h-full">
        <v-progress-circular indeterminate color="white" :size="props.size" :class="props.text ? 'mb-5' : ''" />

        <p v-if="props.text" class="text-white text-h5 text-center">{{ props.text }}</p>
      </div>
    </div>

    <slot v-else></slot>
  </v-dialog>
</template>

<style lang="scss">

</style>
