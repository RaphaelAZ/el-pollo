<script setup lang="ts">
import { type PropType, ref } from 'vue'
import { ConsumableType, type Burger, type Drink } from '@/models/consumable'
import DetailsDialog from '@/components/lists/DetailsDialog.vue'
import { useBasketStore } from '@/stores/basketStore'
import { useSnackbarStore } from '@/stores/snackBarStore'
import { SnackBarStatus } from '@/models/snackBarParams'
import { useUserStore } from '@/stores/userStore'
import router from '@/router'

const props = defineProps({
  item: {
    type: Object as PropType<Burger | Drink>,
    required: true,
  },
  type: {
    type: String as PropType<ConsumableType>,
    required: true
  }
})

const basketStore = useBasketStore();
const snackBarStore = useSnackbarStore();
const userStore = useUserStore();
const showDialog = ref(false);
const showAlert = ref(false);

const closeDialog = () => {
  showDialog.value = false;
}

const addItemToStore = () => {
  if(userStore.isLoggedIn) {
    basketStore.addItem(props.item);
    snackBarStore.showSnackbar({
      message: 'Vous avez ajouté 1 ' + props.item.name + ' au panier !',
      status: SnackBarStatus.SUCCESS,
      timer: 5000
    });
  } else {
    snackBarStore.showSnackbar({
        message: 'Vous devez être connecté pour commander',
        status: SnackBarStatus.ERROR
    })
  }
  
}
</script>

<template>
  <v-card class="bg-info rounded-md d-flex flex-column">
    <v-img v-if="item.image" height="200" :src="item.image" cover />

    <v-card-title class="h-fit">
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
      <v-btn class="flex-grow-1" border @click="addItemToStore" :disabled="item.available === false">
        <Icon icon="material-symbols:add" v-if="item.available === true" />
        {{ item.available === false ? 'En Rupture' : 'Ajouter' }}
      </v-btn>
    </v-card-actions>
  </v-card>

  <v-alert
    v-if="showAlert"
    type="success"
    class="fixed bottom-4 left-1/2 transform -translate-x-1/2"
    color="success"
    icon="$success"
    :text="'Vous avez ajouté 1' + item.name + 'au panier'"
    style="width: 300px; z-index: 9999;"
  ></v-alert>

  <DetailsDialog v-model="showDialog" @close="closeDialog" :item="item" :type="type"></DetailsDialog>
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
