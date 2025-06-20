<script setup lang="ts">
import { type PropType } from 'vue'
import { type Burger, ConsumableType, type Drink } from '@/models/consumable.ts'

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

const emit = defineEmits(['close']);
</script>

<template>
    <v-dialog persistent max-width="500">
        <v-card class="rounded-md d-flex flex-column">
            <v-card-title class="d-flex flex-row justify-space-between align-center">
                <span>
                    {{ item.name }}
                    <v-chip class="mb-1 mr-1" color="success" size="small">
                        {{ item.price }}€
                    </v-chip>
                    <v-chip class="mb-1 mr-1" color="success" size="small">
                        {{ item.available === false ? 'Indisponible' : 'Disponible' }}
                    </v-chip>
                    <v-chip class="mb-1 mr-1" color="success" size="small" v-if="type === ConsumableType.Burger && !!(item as Burger).size">
                        {{ (item as Burger).size }}
                    </v-chip>
                    <v-chip class="mb-1" color="success" size="small" v-if="type === ConsumableType.Drink">
                        {{ (item as Drink).isAlcoholic ? 'Avec Alcool' : 'Sans Alcool' }}
                    </v-chip>
                </span>
                <v-btn @click="emit('close')" color="success" class="rounded-circle" icon size="small">
                    <Icon
                        icon="akar-icons:cross"
                        :width="12"
                        :height="12"
                    />
                </v-btn>
            </v-card-title>

            <v-container>
                <v-img v-if="item.image" height="200" :src="item.image" cover />
                <p v-else>Pas d'image disponible</p>

                <section class="mt-2">
                    <p>{{ item.description }}</p>

                    <section v-if="props.type === ConsumableType.Burger">
                        <v-divider class="mx-4 my-3"></v-divider>

                        <h3 class="mb-3">Ingrédients</h3>
                        <div class="d-flex flex-row gap-5 flex-wrap">
                            <v-chip
                                v-for="(ingredient, key) in (item as Burger).ingredients"
                                :key="key"
                                density="compact"
                                class="mb-1"
                                color="success"
                            >
                                {{ ingredient }}
                            </v-chip>
                        </div>
                    </section>
                </section>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<style scoped lang="ts">

</style>
