<script setup lang="ts">
import { type PropType, ref } from 'vue'
import { type Burger } from '@/models/consumable'
import DetailsDialog from '@/components/lists/DetailsDialog.vue'

const props = defineProps({
  item: {
    type: Object as PropType<Burger>,
    required: true,
  }
})

const showDialog = ref(false);
const closeDialog = () => {
  showDialog.value = false;
}
</script>

<template>
  <v-card :class="'bg-info rounded-md d-flex flex-column' + item.available === false ? 'bg-gray' : 'bg-info'">
    <v-img v-if="item.image" height="200" :src="item.image" cover />

    <v-card-title>
      {{ item.name }}
    </v-card-title>

    <v-divider class="mx-4 mb-1"></v-divider>

    <v-card-actions>
      <v-tooltip
        text="En Savoir Plus"
        location="bottom"
        max-width="200"
      >
        <template v-slot:activator="{ props }">
          <v-btn border @click="showDialog = true">
            <Icon
              icon="mdi:more-horiz"
              v-bind="props"
              width="20"
              color="success"
            />
          </v-btn>
        </template>
      </v-tooltip>
        <v-btn class="flex-grow-1" border>
          <Icon icon="material-symbols:add" />
          Ajouter
        </v-btn>
    </v-card-actions>
  </v-card>

  <DetailsDialog v-model="showDialog" @close="closeDialog" :item="item"></DetailsDialog>
</template>

<style scoped>
.chips-container {
  max-height: 3.5em;
  overflow: hidden;
  text-overflow: ellipsis;
}

.bg-gray {
  background-color: gray;
}
</style>