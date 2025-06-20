<script setup lang="ts">
import { computed, onMounted } from 'vue'
import NavBar from '@/components/navbar/NavBar.vue';
import SnackBar from '@/components/common/SnackBar.vue'
import { useUserStore } from '@/stores/userStore';
import { useConsumableStore } from '@/stores/consumableStore';
import { useSnackbarStore } from "@/stores/snackBarStore";

const snackbar = useSnackbarStore();
const consumableStore = useConsumableStore();

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
