<template>
  <aside>
    <v-navigation-drawer
      expand-on-hover
      rail
      @mouseenter="isExpanded = true"
      @mouseleave="isExpanded = false"
      class="bg-info"
    >
      <v-list>
        <v-list-item class="d-flex align-center ga-3" to="/home" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione-v1:chicken"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded" class="ml-2">El Pollo</v-list-item-title>
        </v-list-item>
      </v-list>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item to="/burgers" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione:hamburger"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Burgers</v-list-item-title>
        </v-list-item>

        <v-list-item to="/builder" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione:bacon"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Mon Burger</v-list-item-title>
        </v-list-item>
        <v-list-item to="/drinks" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione:tropical-drink"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Boissons</v-list-item-title>
        </v-list-item>

        <v-list-item to="/order" rounded="lg" v-if="basketStore.basket.length > 0">
          <template #prepend>
            <Icon
              icon="emojione:shopping-cart"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Commande</v-list-item-title>
        </v-list-item>

        <v-list-item to="/order/history" rounded="lg" v-if="previousOrderStore.previousOrders.length > 0">
          <template #prepend>
            <Icon
              icon="emojione:hourglass-not-done"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Précédentes commandes</v-list-item-title>
        </v-list-item>

      </v-list>
    </v-navigation-drawer>
  </aside>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { useBasketStore } from '@/stores/basketStore.ts'
import { useOrdersHistoryStore } from '@/stores/ordersHistoryStore.ts'

const isExpanded = ref(false);

const basketStore = useBasketStore()
const previousOrderStore = useOrdersHistoryStore()
</script>

<style lang="scss" scoped>
.v-list-item,
.v-list-item:hover {
  background-color: transparent !important;
}
</style>
