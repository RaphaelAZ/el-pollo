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
    <v-dialog v-model="showDialog" persistent max-width="500">
        <v-card class="rounded-md d-flex flex-column">
            <v-card-title class="d-flex flex-row justify-between align-center">
                {{ item.name }}
                <v-btn @click="emit('close')" rounded-circle>
                    <Icon
                        icon="akar-icons:cross"
                        :width="24"
                        :height="24"
                        class="mr-3"
                    />
                </v-btn>
            </v-card-title>
        </v-card>

        <v-container>
            <v-img v-if="item.image" height="200" :src="item.image" cover />
            <p v-else>Pas d'image disponible</p>

            <section>

            </section>
        </v-container>
    </v-dialog>
</template>

<style scoped lang="ts">

</style>
