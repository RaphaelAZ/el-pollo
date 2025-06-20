<template>
  <v-container class="bg-success">
    <v-form ref="formAnchor" v-model="isFormValid" @submit.prevent="handleLogin">
      <v-text-field
        label="E-mail"
        v-model="email"
        :rules="emailRules"
        ref="usernameAnchor"
        id="email-login-input"
      >
        <template #prepend>
          <Icon icon="mdi:account" width="24"></Icon>
        </template>
      </v-text-field>

      <v-text-field
        label="Mot de passe"
        v-model="password"
        :rules="passwordRules"
        id="password-login-input"
        type="password"
      >
        <template #prepend>
          <Icon icon="mdi:key" width="24"></Icon>
        </template>
      </v-text-field>

      <v-btn type="submit" id="submit-login-button" :disabled="!isFormValid" class="mt-5">
        Se connecter
      </v-btn>
    </v-form>
  </v-container>
</template>

<script lang="ts" setup>
import { SnackBarStatus } from '@/models/snackBarParams';
import type { LoginData } from '@/models/user';
import router from '@/router'
import { useSnackbarStore } from '@/stores/snackBarStore';
import { useUserStore } from '@/stores/userStore';
import { passwordRules, emailRules } from "@/utils/rulesUtils";
import { ref } from "vue";

const snackBar = useSnackbarStore();
const userStore = useUserStore();

const email = ref('');
const password = ref('');
const isFormValid = ref(false);

const handleLogin = async () => {
  if (isFormValid.value) {
    const loginData: LoginData = {
      email: email.value,
      password: password.value,
    };

    await userStore.loginAttempt(loginData).then((response: boolean) => {
      if (response) {
        router.push('/home');
      } else {
        snackBar.showSnackbar({
          message: 'Nom d\'utilisateur ou mot de passe incorrect. Veuillez réessayer.',
          status: SnackBarStatus.ERROR,
          timer: 5000
        });
      }
    });
  }
};
</script>
