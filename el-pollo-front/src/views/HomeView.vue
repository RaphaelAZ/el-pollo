<template>
  <div class="w-full my-10 pa-7 rounded-xl" id="main-banner">
    <h1 class="text-center my-5 mb-8 d-flex align-center ga-2 justify-center text-h3">
      <Icon icon="emojione-v1:chicken" />
      El Pollo
    </h1>

    <h2 class="text-center text-h5">Ce sont des burgers et boissons résumés en 5 images:</h2>

    <div class="d-flex flex-row ga-5 align-center justify-center">
      <Icon class="text-h5" width="35" height="35" icon="emojione:hamburger" />
      <Icon class="text-h5" width="35" height="35" icon="emojione:bacon" />
      <Icon class="text-h5" width="35" height="35" icon="emojione:tropical-drink" />
      <Icon class="text-h5" width="35" height="35" icon="emojione:shopping-cart" />
      <Icon class="text-h5" width="35" height="35" icon="emojione:smiling-face-with-heart-eyes" />
    </div>
  </div>

  <h3 class="text-center text-h4 w-full mb-2">
    <Icon width="50" height="50" />
    Nous proposons:
  </h3>

  <v-container style="z-index: 1">
    <v-row>
      <v-col cols="4">
        <home-link-card
          :carousel="allBurgerPhotos"
          title="Burgers"
        >
          <v-card-actions>
            <v-btn color="info" to="/burgers">
              <Icon icon="emojione:hamburger" />
              Voir
            </v-btn>
          </v-card-actions>

        </home-link-card>
      </v-col>

      <v-col cols="4">
        <home-link-card
          title="Boissons"
          :carousel="allDrinksPhotos"
        >
          <v-card-actions>
            <v-btn color="info" to="/drinks">
              <Icon icon="emojione:hamburger" />
              Voir
            </v-btn>
          </v-card-actions>

        </home-link-card>
      </v-col>

      <v-col cols="4">
        <home-link-card
          title="Créer ton burger"
          image='/blueprint.jpg'
        >
          <v-card-actions>
            <v-btn color="info" to="/builder">
              <Icon icon="emojione:bacon" />
              Créer mon burger
            </v-btn>
          </v-card-actions>

        </home-link-card>
      </v-col>
    </v-row>
  </v-container>

  <!-- Container for the images -->
  <div style="z-index: -1; display: none !important;">
    <Icon id="top-left-icon" :class="`${commonIconsClass} left-0 top-0`" icon="emojione:hamburger" />
    <Icon id="bot-right-icon" :class="`${commonIconsClass} right-0 bottom-0`" icon="emojione:fork-and-knife" />
  </div>
</template>

<script lang="ts" setup>
import HomeLinkCard from '@/components/home/HomeLinkCard.vue'

const commonIconsClass = "position-absolute w-33 h-auto opacity-30"

const allBurgerPhotos = [
  'https://foodish-api.com/images/burger/burger30.jpg',
  'https://foodish-api.com/images/burger/burger32.jpg',
  'https://foodish-api.com/images/burger/burger81.jpg',
  'https://foodish-api.com/images/burger/burger26.jpg',
  'https://foodish-api.com/images/burger/burger62.jpg',
  'https://foodish-api.com/images/burger/burger69.jpg',
]

const allDrinksPhotos = [
  'https://www.thecocktaildb.com/images/media/drink/uuytrp1474039804.jpg',
  'https://www.thecocktaildb.com/images/media/drink/zj1usl1504884548.jpg',
  'https://www.thecocktaildb.com/images/media/drink/8cl9sm1582581761.jpg',
  'https://www.thecocktaildb.com/images/media/drink/m1suzm1487603970.jpg',
  'https://www.thecocktaildb.com/images/media/drink/sih81u1504367097.jpg',
  'https://www.thecocktaildb.com/images/media/drink/9myuc11492975640.jpg',
  'https://www.thecocktaildb.com/images/media/drink/20d63k1504885263.jpg',
  'https://www.thecocktaildb.com/images/media/drink/ssqpyw1472719844.jpg'
]
</script>

<style scoped>
#top-left-icon, #bot-right-icon {
  z-index: -1;
}

#top-left-icon {
  transform: rotate(-24deg);
}

#bot-right-icon {
  transform: rotate(12deg);
}

#main-banner {
  background-color: rgba(var(--v-theme-info), 0.35);
}
</style>
