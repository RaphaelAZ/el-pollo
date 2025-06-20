<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import NavBar from '@/components/NavBar.vue';
import UserModal from '@/components/UserModal.vue'
import SnackBar from '@/components/common/SnackBar.vue'
import { useUserStore } from '@/stores/userStore';
import { useConsumableStore } from '@/stores/consumableStore';
import { useSnackbarStore } from "@/stores/snackBarStore";

const userStore = useUserStore();
const snackbar = useSnackbarStore();
const consumableStore = useConsumableStore();
const showModal = computed(() => !userStore.activeUser);

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

    <SnackBar
      :snack-msg="snackbar.message"
      :snackbar-show="snackbar.isOpen"
      :snackbar-status="snackbar.status"
    />
  </v-app>
</template>

<style lang="scss" scoped>
</style>
