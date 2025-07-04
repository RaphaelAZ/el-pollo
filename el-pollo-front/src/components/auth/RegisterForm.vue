<template>
  <v-container>
      <v-form
      ref="formAnchor"
      v-model="valid"
      @submit.prevent="handleRegister"
      >
        <v-text-field label="Nom d'utilisateur" v-model="username" :rules="usernameRules" >
          <template #prepend>
            <Icon icon="mdi:account" width="24"></Icon>
          </template>
        </v-text-field>

        <v-text-field label="E-mail" v-model="email" :rules="emailRules" >
          <template #prepend>
            <Icon icon="mdi:email" width="24"></Icon>
          </template>
        </v-text-field>

        <v-text-field label="Mot de passe" v-model="password" :rules="passwordRules" type="password" >
          <template #prepend>
            <Icon icon="mdi:key" width="24"></Icon>
          </template>
        </v-text-field>

        <v-text-field label="Confirmer le mot de passe" v-model="confirmPassword" :rules="confirmRules" type="password" ref="confirmPasswordFieldRef">
          <template #prepend>
            <Icon icon="mdi:key" width="24"></Icon>
          </template>
        </v-text-field>

        <v-row class="flex align-end text-center">
          <v-col cols="5">
            <v-btn :disabled="!valid" class="mt-3" type="submit" id="submit-register-button">S'inscrire</v-btn>
          </v-col>
          <v-col cols="7">
            <span class="pl-2 mt-3 mb-2 font-sm">Déjà inscrit ? <router-link to="/login" class="link">Connectez-vous</router-link></span>
          </v-col>
        </v-row>
      </v-form>
  </v-container>

  <loading-dialog :visible="isLoading" />
</template>

<script lang="ts" setup>
import { ref, computed, watch } from 'vue'
import router from '@/router'
import { emailRules, passwordRules, usernameRules, confirmPasswordRules } from '@/utils/rulesUtils'
import type { LoginData, RegisterData } from '@/models/user'
import { SnackBarStatus } from '@/models/snackBarParams'
import { useUserStore } from '@/stores/userStore'
import { useSnackbarStore } from '@/stores/snackBarStore'
import LoadingDialog from '@/components/common/LoadingDialog.vue'

const userStore = useUserStore()
const snackbarStore = useSnackbarStore()

const username = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const confirmPasswordFieldRef = ref();
const valid = ref(false)

const isLoading = ref<boolean>(false)

const confirmRules = computed(() => confirmPasswordRules(password));

watch(password, () => {
  if (confirmPasswordFieldRef.value?.validate) {
    confirmPasswordFieldRef.value.validate();
  }
});

async function handleRegister() {
  if (valid.value) {
    const registerData: RegisterData = {
      email: email.value,
      password: password.value,
      username: username.value
    }

    isLoading.value = true

    const registerSuccess = await userStore.registerAttempt(registerData)

    if (registerSuccess) {
      const credentials: LoginData = {
        email: email.value,
        password: password.value,
      }

      await userStore.loginAttempt(credentials).then((resp: boolean) => {
        if(resp) {
          snackbarStore.showSnackbar({
            message: "Connexion réussie! Vous allez être redirigé vers la page d'accueil dans quelques secondes.",
            status: SnackBarStatus.SUCCESS,
            timer: 5000,
          })

          router.push('/home')
        }
      }).finally(() => {
        isLoading.value = false
      })

    } else {
      snackbarStore.showSnackbar({
        message: 'Une erreur est survenue lors de la connexion. Veuillez réessayer plus tard.',
        status: SnackBarStatus.ERROR,
        timer: 5000,
      })

      isLoading.value = false
    }

  }
}
</script>

<style lang="scss" scoped>
.link:hover {
  text-decoration: underline;
}
</style>
