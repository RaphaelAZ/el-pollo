<template>
  <aside>
    <v-navigation-drawer
      expand-on-hover
      rail
      @mouseenter="isExpanded = true"
      @mouseleave="isExpanded = false"
      class="bg-info"
    >
      <v-list>
        <navbar-item
          class="d-flex align-center ga-3"
          title="El Pollo"
          :is-parent-expanded="isExpanded"
          to="/home"
          icon="emojione-v1:chicken"
        />
      </v-list>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <navbar-item
          title="Burgers"
          :is-parent-expanded="isExpanded"
          to="/burgers"
          icon="emojione:hamburger"
        />

        <navbar-item
          title="Mon Burger"
          :is-parent-expanded="isExpanded"
          to="/builder"
          icon="emojione:bacon"
        />

        <navbar-item
          title="Boissons"
          :is-parent-expanded="isExpanded"
          to="/drinks"
          icon="emojione:tropical-drink"
        />

        <navbar-item
          title="Commande"
          :is-parent-expanded="isExpanded"
          to="/order"
          icon="emojione:shopping-cart"
          :condition="basketStore.basket.length > 0"
        />

        <navbar-item
          title="Historique commandes"
          :is-parent-expanded="isExpanded"
          to="/order/history"
          icon="emojione:hourglass-not-done"
          :condition="userStore.isLoggedIn"
        />

        <navbar-item
          title=" "
          class="mt-15"
          :is-parent-expanded="isExpanded"
          to="/pollo"
        />
      </v-list>
      <template #append>
        <section class="mb-2" v-if="userStore.isLoggedIn">
          <navbar-item
            title="Profil"
            :is-parent-expanded="isExpanded"
            to="/login"
            icon="emojione:baby-chick"
          />
        </section>
        <section class="mb-2" v-if="!userStore.isLoggedIn">
          <navbar-item
            title="Connexion"
            :is-parent-expanded="isExpanded"
            to="/login"
            icon="emojione:key"
          />
          <navbar-item
            title="Inscription"
            :is-parent-expanded="isExpanded"
            to="/register"
            icon="emojione:paperclip"
          />
        </section>
      </template>
    </v-navigation-drawer>
  </aside>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import { useBasketStore } from '@/stores/basketStore.ts'
import { useOrderStore } from '@/stores/orderStore.ts'
import NavbarItem from '@/components/navbar/NavbarItem.vue'
import { useUserStore } from '@/stores/userStore';

const isExpanded = ref(false);
const userStore = useUserStore();

const basketStore = useBasketStore()
</script>

<style lang="scss" scoped>
.v-list-item,
.v-list-item:hover {
  background-color: transparent !important;
}
</style>
