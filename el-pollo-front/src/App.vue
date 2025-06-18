<script setup lang="ts">
import { ref, computed } from 'vue'
import NavBar from '@/components/NavBar.vue';
import UserModal from '@/components/UserModal.vue'
import { useUserStore } from '@/stores/userStore';

const userStore = useUserStore();
const showModal = computed(() => !true);
</script>

<template>
  <v-app class="bg-secondary">
    <NavBar></NavBar>

    <v-main>
      <v-container>
        <router-view/>
      </v-container>
    </v-main>

    <v-dialog v-model="showModal" persistent max-width="600">
      <UserModal/>
    </v-dialog>
  </v-app>
</template>

<style lang="scss" scoped>
</style>
