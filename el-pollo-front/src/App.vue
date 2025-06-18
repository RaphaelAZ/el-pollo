<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import NavBar from '@/components/NavBar.vue';
import UserModal from '@/components/UserModal.vue'
import { useUserStore } from '@/stores/userStore';
import { useConsumableStore } from '@/stores/consumableStore';

const userStore = useUserStore();
const consumableStore = useConsumableStore();
const showModal = computed(() => !true);

onMounted(() => {
  consumableStore.getAllConsumable();
})

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
