<template>
    <v-card class="pa-4 rounded-xl" elevation="10">
        <v-card-text class="text-body-1 text-center my-1">
            Nous utiliserons votre nom pour une meilleure expérience utilisateur.
        </v-card-text>

        <v-container>
            <v-text-field
                label="Nom d'utilisateur"
                v-model="username"
                :rules="usernameRules"
                prepend-icon="mdi-account"
                id="username-input"
                variant="solo"
            >
                <template #prepend>
                    <Icon
                        icon="mdi:account-outline"
                        :width="36"
                        :height="36"
                    />
                </template>
            </v-text-field>
        </v-container>

        <v-card-actions class="justify-center mt-4">
            <v-btn
                color="info"
                variant="flat"
                class="px-6 rounded-lg"
                type="submit"
            >
                Continuer
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import { useUserStore } from '@/stores/userStore';
import { usernameRules } from '@/utils/rulesUtils';

const authStore = useUserStore();
const authFormRef = ref<HTMLFormElement | null>(null);
const username = ref<string>();

const confirmUsername = () => {
    if(authFormRef.value.validate()) {
        authStore.fetchUser(username.value);
    }
}
</script>