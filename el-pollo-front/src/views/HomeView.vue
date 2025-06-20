<template>
  <h1>El Pollo</h1>

  <v-container>
    <v-row>
      <v-col cols="4">
        <home-link-card
          title="Burgers"
        >
          <v-card-actions>

          </v-card-actions>
        </home-link-card>
      </v-col>

      <v-col cols="4">

      </v-col>

      <v-col cols="4">

      </v-col>
    </v-row>
  </v-container>

  <!-- Container for the images -->
  <div>
    <Icon id="top-left-icon" :class="`${commonIconsClass} left-0 top-0`" icon="emojione:hamburger" />
    <Icon id="bot-right-icon" :class="`${commonIconsClass} right-0 bottom-0`" icon="emojione:fork-and-knife" />
  </div>
</template>

<script lang="ts" setup>
import HomeLinkCard from '@/components/home/HomeLinkCard.vue'

const commonIconsClass = "position-absolute w-33 h-auto opacity-30"
</script>

<style scoped>
#top-left-icon {
  transform: rotate(-24deg);
}

#bot-right-icon {
  transform: rotate(12deg);
}
</style>
