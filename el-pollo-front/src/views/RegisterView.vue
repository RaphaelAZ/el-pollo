<template>
    <v-container class="mt-8">
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card class="pa-4 bg-success" elevation="4">
                    <v-card-title class="text-h5">Inscription</v-card-title>
                    <v-card-text>
                        <RegisterForm />
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup lang="ts">
import RegisterForm from '@/components/auth/RegisterForm.vue';
</script>