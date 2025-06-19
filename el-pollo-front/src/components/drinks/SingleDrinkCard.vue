<script setup lang="ts">
import { computed, type PropType, ref } from 'vue'
import type { Drink } from '@/models/consumable.ts'
import SingleDrinkDetails from '@/components/drinks/SingleDrinkDetails.vue'
import { useBasketStore } from '@/stores/basketStore.ts'
import { useSnackbarStore } from '@/stores/snackBarStore.ts'
import { SnackBarStatus } from '@/models/snackBarParams.ts'

const props = defineProps({
  drink: {
    type: Object as PropType<Drink>,
    required: true
  }
})

const basketStore = useBasketStore();
const snackBarStore = useSnackbarStore();

const computedAlcoolIcon = computed(() => {
  return props.drink.isAlcoholic ? 'mdi:alcohol' : 'material-symbols:no-drinks'
})

const computedAlcoolText = computed(() => {
  return props.drink.isAlcoholic ? 'Alcoolisée' : 'Non Alcoolisée'
})

const showDialog = ref(false);

const closeDialog = () => {
  showDialog.value = false;
}

const addDrinkToCart = (): void => {
  basketStore.addItem(props.drink)

  snackBarStore.showSnackbar({
    message: `Vous avez ajouté 1 ${props.drink.name} au pannier !`,
    status: SnackBarStatus.SUCCESS,
    timer: 5000
  });
}
</script>

<template>
  <v-card class="bg-info">
    <v-img v-if="drink.image" height="200" :src="drink.image" cover />

    <v-card-title>{{ drink.name }}</v-card-title>

    <!-- Texte si alcoolisé ou non -->
    <v-card-text class="d-flex items-center">
      <Icon :icon="computedAlcoolIcon" />
      <p>{{ computedAlcoolText }}</p>
    </v-card-text>

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
      <v-btn class="flex-grow-1" border @click="addDrinkToCart">
        <Icon icon="material-symbols:add" />
        Ajouter
      </v-btn>
    </v-card-actions>
  </v-card>

  <v-dialog v-model="showDialog" max-width="500">
    <SingleDrinkDetails :drink="drink" @close="closeDialog" />
  </v-dialog>
</template>

<style scoped>

</style>
