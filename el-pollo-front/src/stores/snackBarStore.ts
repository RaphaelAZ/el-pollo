import { defineStore } from 'pinia';
import { type snackBarParams, SnackBarStatus } from "@/models/snackBarParams";

export const useSnackbarStore = defineStore('SnackbarStore', {
  state: (): SnackBarState => {
    return {
      isOpen: false,
      message: '',
      status: SnackBarStatus.INFO
    }
  },
  actions: {
    showSnackbar(params: snackBarParams) {
      this.message = params.message;
      this.status = params.status;
      this.isOpen = true;

      setTimeout(() => {
        this.closeSnackbar();
      }, params.timer ?? 5000)
    },

    closeSnackbar () {
      this.isOpen = false
    }
  }
});

interface SnackBarState {
  isOpen: boolean,
  message: string,
  status: SnackBarStatus,
  data?: object
}