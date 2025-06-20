<script setup lang="ts">
import type { Burger, Ingredients } from '@/models/consumable';
import { SnackBarStatus } from '@/models/snackBarParams';
import { useBasketStore } from '@/stores/basketStore';
import { useConsumableStore } from '@/stores/consumableStore';
import { useSnackbarStore } from '@/stores/snackBarStore';
import { computed, ref, watch } from 'vue';

const consuStore = useConsumableStore();
const basketStore = useBasketStore();
const snackBarStore = useSnackbarStore();
const buildedBurger = ref<Burger>({
    id: -1,
    name: "",
    description: "Burger Personnalisé",
    price: 4,
    ingredients: []
});
const burgerForm = ref();

const ingredients = computed(() => {
    console.log(consuStore.allIngredients);
    return consuStore.allIngredients ?? null
});

const addIngredient = (ingredient: string) => {
  buildedBurger.value!.ingredients!.push(ingredient);
};

const removeIngredient = (index: number) => {
  buildedBurger.value!.ingredients!.splice(index, 1);
};

const burgerPrix = computed(() => {
    return buildedBurger.value.ingredients!.length * 1.50 + 4
})

const formInvalid = computed(() => buildedBurger.value.ingredients?.length === 0 || !buildedBurger.value.name);

const addBurgerToCart = () => {
    basketStore.addItem(buildedBurger.value);
    snackBarStore.showSnackbar({
        message: 'Le burger' + buildedBurger.value.name + 'a bien été ajouté au panier !',
        status: SnackBarStatus.SUCCESS
    })
}
</script>

<template>
  <v-container>
    <section class="d-flex flex-row justify-space-around ga-10">
        <v-card class="pa-4 bg-success" max-width="500" elevation="3">
            <v-card-title>🍔 Créer votre burger</v-card-title>

            <v-form v-model="burgerForm" @submit.prevent="addBurgerToCart">
                <v-text-field
                    v-model="buildedBurger.name"
                    label="Nom du burger"
                    outlined
                    dense
                ></v-text-field>

                <v-divider class="my-2"></v-divider>

                <div class="text-subtitle-1 mb-2">Ajouter des ingrédients :</div>
                <div class="text-subtitle-2 mb-1">Pains :</div>
                <v-btn
                    v-for="ingredient in ingredients?.bread"
                    :key="ingredient"
                    class="ma-1"
                    size="small"
                    variant="tonal"
                    @click="addIngredient(ingredient)"
                >
                    {{ ingredient }}
                </v-btn>

                <div class="text-subtitle-2 mb-1">Viandes :</div>
                <v-btn
                    v-for="ingredient in ingredients?.meat"
                    :key="ingredient"
                    class="ma-1"
                    size="small"
                    variant="tonal"
                    @click="addIngredient(ingredient)"
                >
                    {{ ingredient }}
                </v-btn>

                <div class="text-subtitle-2 mb-1">Légumes :</div>
                <v-btn
                    v-for="ingredient in ingredients?.vegetables"
                    :key="ingredient"
                    class="ma-1"
                    size="small"
                    variant="tonal"
                    @click="addIngredient(ingredient)"
                >
                    {{ ingredient }}
                </v-btn>

                <div class="text-subtitle-2 mb-1">Sauces :</div>
                <v-btn
                    v-for="ingredient in ingredients?.sauce"
                    :key="ingredient"
                    class="ma-1"
                    size="small"
                    variant="tonal"
                    @click="addIngredient(ingredient)"
                >
                    {{ ingredient }}
                </v-btn>

                <v-divider class="my-4"></v-divider>

                <v-btn
                    color="info"
                    class="mt-4"
                    :disabled="formInvalid"
                    type="submit"
                >
                    Créer le burger
                </v-btn>
            </v-form>
        </v-card>

        <v-card class="pa-4 bg-success" max-width="500" min-width="400" min-height="0" elevation="3">
            <section class="d-flex flex-row justify-space-between align-center">
                <v-card-title>🍔 Résumé du burger</v-card-title>
                <v-chip class="mb-1 mr-1" color="primary" size="large">{{ burgerPrix.toString() }}€ </v-chip>
            </section>
            

            <v-divider class="my-4"></v-divider>

            <div class="text-subtitle-1 mb-1">Aperçu du burger :</div>

            <v-list class="bg-success">
                <v-list-item
                v-for="(item, index) in buildedBurger.ingredients"
                :key="index"
                class="d-flex ga-1 justify-space-between w-100"
                >
                <span>{{ item }}</span>
                <v-btn
                    icon
                    size="x-small"
                    color="error"
                    @click="removeIngredient(index)"
                    class="ml-2"
                >
                    <Icon
                        icon="mdi:trash"
                        :width="20"
                        :height="20"
                    />
                </v-btn>
                </v-list-item>
            </v-list>
        </v-card>
    </section>
  </v-container>
</template>