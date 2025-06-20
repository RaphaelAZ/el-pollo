<template>
  <v-container class="mt-8">
    <v-row justify="center">
      <v-col cols="12" sm="8" md="6">
        <v-card class="pa-4 bg-success" elevation="4">
          <v-card-title class="text-h5">Connexion</v-card-title>
          <v-card-text>
            <LoginForm />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import LoginForm from "@/components/auth/LoginForm.vue";
</script>
