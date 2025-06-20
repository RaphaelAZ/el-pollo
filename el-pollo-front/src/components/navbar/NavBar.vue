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
        <navbar-item
          class="d-flex align-center ga-3"
          title="El Pollo"
          :is-parent-expanded="isExpanded"
          to="/home"
          icon="emojione-v1:chicken"
        />
      </v-list>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <navbar-item
          title="Burgers"
          :is-parent-expanded="isExpanded"
          to="/burgers"
          icon="emojione:hamburger"
        />

        <navbar-item
          title="Mon Burger"
          :is-parent-expanded="isExpanded"
          to="/builder"
          icon="emojione:bacon"
        />

        <navbar-item
          title="Boissons"
          :is-parent-expanded="isExpanded"
          to="/drinks"
          icon="emojione:tropical-drink"
        />

        <navbar-item
          title="Commande"
          :is-parent-expanded="isExpanded"
          to="/order"
          icon="emojione:shopping-cart"
          :condition="basketStore.basket.length > 0"
        />

        <navbar-item
          title="Historique commandes"
          :is-parent-expanded="isExpanded"
          to="/order/history"
          icon="emojione:hourglass-not-done"
          :condition="previousOrderStore.previousOrders.length > 0"
        />

        <navbar-item
          title=" "
          class="mt-10"
          :is-parent-expanded="isExpanded"
          to="/pollo"
          :condition="basketStore.basket.length > 0"
        />

      </v-list>
    </v-navigation-drawer>
  </aside>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { useBasketStore } from '@/stores/basketStore.ts'
import { useOrdersHistoryStore } from '@/stores/ordersHistoryStore.ts'
import NavbarItem from '@/components/navbar/NavbarItem.vue'

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
