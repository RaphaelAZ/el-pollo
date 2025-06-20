<script setup lang="ts">
import type { Burger } from '@/models/consumable';
import { computed, ref } from 'vue';


const buildedBurger = ref<Burger>({
    id: -1,
    name: "",
    description: "",
    price: 4,
    ingredients: []
});
const burgerForm = ref();

const addIngredient = (ingredient: string) => {
  buildedBurger.value!.ingredients!.push(ingredient);
};

const removeIngredient = (index: number) => {
  buildedBurger.value!.ingredients!.splice(index, 1);
};

const saveBurger = () => {
  console.log('Burger créé:', buildedBurger);
};

const formInvalid = computed(() => buildedBurger.value.ingredients?.length === 0 || !buildedBurger.value.name);
</script>

<template>
  <v-container>
    <v-card class="pa-4" max-width="500" elevation="3">
      <v-card-title>🍔 Créer votre burger</v-card-title>

      <v-form v-model="burgerForm" @submit.prevent="saveBurger">
        <v-text-field
            v-model="buildedBurger.name"
            label="Nom du burger"
            outlined
            dense
            class="mb-4"
        ></v-text-field>

        <v-divider class="my-4"></v-divider>

        <div class="text-subtitle-1 mb-2">Ajouter des ingrédients :</div>
        <v-btn
            v-for="ingredient in buildedBurger.ingredients"
            :key="ingredient"
            class="ma-1"
            size="small"
            variant="tonal"
            @click="addIngredient(ingredient)"
        >
            {{ ingredient }}
        </v-btn>

        <v-divider class="my-4"></v-divider>

        <div class="text-subtitle-1 mb-2">Aperçu du burger :</div>

        <v-list>
            <v-list-item
            v-for="(item, index) in buildedBurger.ingredients"
            :key="index"
            class="d-flex justify-space-between"
            >
            <span>{{ item }}</span>
            <v-btn
                icon
                size="x-small"
                color="error"
                @click="removeIngredient(index)"
            >
                <v-icon>mdi-close</v-icon>
            </v-btn>
            </v-list-item>
        </v-list>

        <v-btn
            color="primary"
            class="mt-4"
            :disabled="formInvalid"
            type="submit"
        >
            Créer le burger
        </v-btn>
      </v-form>
    </v-card>
  </v-container>
</template>