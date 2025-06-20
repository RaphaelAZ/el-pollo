<script setup lang="ts">
import { computed, onMounted } from 'vue'
import NavBar from '@/components/navbar/NavBar.vue';
import UserModal from '@/components/UserModal.vue'
import SnackBar from '@/components/common/SnackBar.vue'
import { useUserStore } from '@/stores/userStore';
import { useConsumableStore } from '@/stores/consumableStore';
import { useSnackbarStore } from "@/stores/snackBarStore";
import LoginView from './views/LoginView.vue';

const userStore = useUserStore();
const snackbar = useSnackbarStore();
const consumableStore = useConsumableStore();
const showModal = computed(() => !userStore.activeUser);

const showLogin = ref<boolean>(false);
const showRegister = ref<boolean>(false);

onMounted(() => {
  consumableStore.getAllConsumable();
})
</script>

<template>
  <v-app class="bg-secondary relative">
    <NavBar></NavBar>

    <v-main>
      <v-container>
        <router-view/>
      </v-container>
    </v-main>

    <SnackBar
      :snack-msg="snackbar.message"
      :snackbar-show="snackbar.isOpen"
      :snackbar-status="snackbar.status"
    />
  </v-app>
</template>

<style lang="scss" scoped>
</style>
