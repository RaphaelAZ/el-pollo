<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
        expand-on-hover
        rail
        @mouseenter="isExpanded = true"
        @mouseleave="isExpanded = false"
      >
        <v-list class="d-flex align-center">
          <v-list-item class="drawer-head">
            <Icon
              icon="emojione-v1:chicken"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300"
            />
            <v-list-item-title v-if="isExpanded" class="ml-2">El Pollo</v-list-item-title>
          </v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item>
            <Icon
              icon="emojione:hamburger"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300"
            />
            <v-list-item-title v-if="isExpanded">Menus</v-list-item-title>
          </v-list-item>
          <v-list-item>
            <Icon
              icon="emojione:french-fries"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300"
            />
            <v-list-item-title v-if="isExpanded">Seul</v-list-item-title>
          </v-list-item>
          <v-list-item>
            <Icon
              icon="emojione:tropical-drink"
              :width="isExpanded ? 36 : 24"
              :height="isExpanded ? 36 : 24"
              class="transition-all duration-300"
            />
            <v-list-item-title v-if="isExpanded">Boissons</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-main style="height: 250px"></v-main>
    </v-layout>
  </v-card>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from 'vue';

const isExpanded = ref(false);

onMounted(() => {
  const drawer = document.querySelector('.v-navigation-drawer');
  if (drawer) {
    drawer.addEventListener('mouseenter', () => {
      isExpanded.value = true;
    });
    drawer.addEventListener('mouseleave', () => {
      isExpanded.value = false;
    });
  }
});
</script>