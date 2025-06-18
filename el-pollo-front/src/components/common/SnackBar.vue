<template>
  <v-snackbar
    v-model="snackbarRef"
    :color="snackbarStatus"
  >
    <div class="flex flex-row ga-4 justify-space-between align-center">
      <span class="flex flex-wrap mr-2">{{ snackMsg }}</span>
      <v-btn
        size="x-small"
        variant="text"
        density="default"
        elevation="1"
        @click="closeSnackbar"
        icon
      >
        <Icon
            icon="akar-icons:cross"
            :width="12"
            :height="12"
        />
      </v-btn>
    </div>
  </v-snackbar>
</template>

<script lang="ts" setup>
import { toRef } from 'vue'
import { useSnackbarStore } from "@/stores/snackBarStore";

const props = defineProps({
  snackbarShow: Boolean,
  snackMsg: String,
  snackbarStatus: String,
})

const snackbar = useSnackbarStore()
const snackbarRef = toRef(props, 'snackbarShow')

const closeSnackbar = () => {
  snackbar.closeSnackbar();
}
</script>