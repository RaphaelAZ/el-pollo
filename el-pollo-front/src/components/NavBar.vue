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
        <v-list-item to="/home" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione:hamburger"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Menus</v-list-item-title>
        </v-list-item>
        <v-list-item to="/home" rounded="lg">
          <template #prepend>
            <Icon
              icon="emojione:french-fries"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300 mr-3"
            />
          </template>
          <v-list-item-title v-if="isExpanded">Seul</v-list-item-title>
        </v-list-item>
        <v-list-item to="/home" rounded="lg">
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

        <v-list-item to="/order" rounded="lg">
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
      </v-list>
    </v-navigation-drawer>
  </aside>
</template>

<script lang="ts" setup>
import { ref } from 'vue';

const isExpanded = ref(false);
</script>

<style lang="scss" scoped>
.v-list-item,
.v-list-item:hover {
  background-color: transparent !important;
}
</style>
