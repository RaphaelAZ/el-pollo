<template>
  <section
    class="position-relative"
    style="width: 100vw; height: 100vh; overflow: hidden"
  >
    <v-img
      v-for="(gif, index) in gifs"
      :key="index"
      :src="gif.src"
      width="300"
      class="position-absolute transition"
      :class="gif.animation"
      :style="{
        top: gif.top + 'px',
        left: gif.left + 'px',
      }"
    ></v-img>
  </section>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue'

const gifs = ref([
  { src: '/img/reyOhio.gif', top: 0, left: 0, animation: 'rotate-slow' },
  { src: '/img/pollo.gif', top: 0, left: 0, animation: 'bounce' },
  { src: '/img/explode.gif', top: 0, left: 0, animation: 'wiggle' },
  { src: '/img/MM.gif', top: 0, left: 0, animation: 'scale-pulse' },
  { src: '/img/AAA.gif', top: 0, left: 0, animation: '' },
])

const moveGifs = () => {
  gifs.value.forEach(gif => {
    const maxTop = window.innerHeight - 150
    const maxLeft = window.innerWidth - 150

    gif.top = Math.random() * maxTop
    gif.left = Math.random() * maxLeft
  })
}

onMounted(() => {
  moveGifs()
  setInterval(moveGifs, 2000)
})
</script>

<style scoped>
.position-relative {
  position: relative;
}

.position-absolute {
  position: absolute;
}

.transition {
  transition: top 1.5s ease-in-out, left 1.5s ease-in-out;
}

/* Animations */

@keyframes rotate-slow {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.rotate-slow {
  animation: rotate-slow 10s linear infinite;
}

@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

.bounce {
  animation: bounce 1.5s ease-in-out infinite;
}

@keyframes wiggle {
  0%, 100% { transform: rotate(-5deg); }
  50% { transform: rotate(5deg); }
}

.wiggle {
  animation: wiggle 0.8s ease-in-out infinite;
}

@keyframes scale-pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.2); }
}

.scale-pulse {
  animation: scale-pulse 2s ease-in-out infinite;
}
</style>
