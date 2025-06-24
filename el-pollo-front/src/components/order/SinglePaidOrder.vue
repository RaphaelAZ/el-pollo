<script setup lang="ts">
import { computed, type PropType } from 'vue'
import type { PreviousPaidOrder } from '@/models/order.ts'
import { sIfCount } from '@/utils/string-utils.ts'
import type { Consumable } from '@/models/consumable.ts'
import { getTotalForItem } from '@/utils/consumable-utils.ts'

const props = defineProps({
  order: {
    type: Object as PropType<PreviousPaidOrder>,
    required: true
  }
})

const computedOrderDate = computed(() => {
  const orderedAt: Date = new Date(props.order.orderedAt * 1000)

  const date = orderedAt.toLocaleDateString()
  const time = orderedAt.toLocaleTimeString()
  return `${date} à ${time}`
})

const computedNumberOfItems = computed(() => {
  const numberOfItems = props.order.items.length

  return `${numberOfItems} ${sIfCount('item', numberOfItems)}`
})

const tableHeader = [
  { title: 'Item', sortable: true, key: 'name' },
  { title: 'Quantité', sortable: true, key: 'quantity' },
  { title: 'Total', sortable: true, key: 'total' },
]

</script>

<template>
  <v-card color="info">
    <v-card-title>Commande #{{ order.uid }}</v-card-title>

    <v-card-subtitle>
      Commandé le {{ computedOrderDate }}
      <Icon icon="mdi:dot" />
      {{ computedNumberOfItems }}
      <Icon icon="mdi:dot" />
      <p>Total: {{ order.total }} €</p>
    </v-card-subtitle>

    <v-divider></v-divider>

    <v-container>
      <v-card-text>

        <v-expansion-panels>
          <v-expansion-panel title="Livrée au">
            <v-expansion-panel-text>
              <v-row>
                <v-col cols="6">
                  <p class="text-label">Adresse</p>
                  <i>{{ order.place.address }}</i>
                </v-col>

                <v-col cols="3">
                  <p class="text-label">Code postal</p>
                  <i>{{ order.place.postalCode }}</i>
                </v-col>

                <v-col cols="3">
                  <p class="text-label">Ville</p>
                  <i>{{ order.place.city }}</i>
                </v-col>
              </v-row>
            </v-expansion-panel-text>
          </v-expansion-panel>

          <v-expansion-panel
            v-if="order.items.length > 0"
            title="Items"
          >
            <v-expansion-panel-text>
              <v-data-table
                :headers="tableHeader"
                :items="order.items"
                :items-per-page="-1"
                hide-default-footer
              >

                <template #item.name="{ item }">
                  <div class="d-flex align-center ga-2">
                    <v-avatar>
                      <v-img
                        :src="item.image"
                      />
                    </v-avatar>

                    <span>{{ item.name }}</span>
                  </div>
                </template>

                <template #item.total="{ item }">
                  {{ getTotalForItem(item as Consumable) }}
                </template>

              </v-data-table>
            </v-expansion-panel-text>
          </v-expansion-panel>

        </v-expansion-panels>

      </v-card-text>

    </v-container>
  </v-card>
</template>

<style scoped>
.text-label {
  width: 100%;
  border-bottom: 1px solid rgb(var(--v-theme-secondary));
  margin-bottom: 0.5rem;
}
</style>
