<script setup lang="ts">
import { ref } from 'vue';
import type { Consumable } from '@/models/consumable.ts'
import ListItemCard from '@/components/lists/ListItemCard.vue'

const props = defineProps({
  item: {
    type: Object as PropType<Burger>,
    required: true,
  }
})
const burgerDetails = ref<Burge | null>();

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
                    <v-chip class="mb-1" color="success" size="small">
                        {{ item.available === false ? 'Indisponible' : 'Disponible' }}
                    </v-chip>
                    <v-chip class="mb-1" color="success" size="small" v-if="!!item.size">
                        {{ item.size }}
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
            </v-container>
        </v-card>
    </v-dialog>
</template>

<style scoped lang="ts">

</style>
