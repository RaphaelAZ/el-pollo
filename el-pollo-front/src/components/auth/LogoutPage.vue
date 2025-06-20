<template>
  <div>
    <button @click="logout">Se déconnecter</button>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'LogoutPage',
  methods: {
    logout() {
      localStorage.removeItem('jwt_token');
      this.$router.push('/login');
    },
  },
});
</script>
