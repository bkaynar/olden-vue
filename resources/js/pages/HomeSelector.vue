<template>
  <component
    :is="isMobile ? MobileLayout : MainLayout"
  >
    <component
      :is="isMobile ? MobileHome : Home"
      v-bind="props"
    />
  </component>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'
import MobileLayout from '@/layouts/MobileLayout.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import MobileHome from '@/pages/MobileHome.vue';
import Home from '@/pages/Home.vue';

// Props'ları tanımla
const props = defineProps<{
  carouselItems?: any[]
  lastWinners?: any[]
  allGames?: any[]
  liveCasinoGames?: any[]
  oyunlar?: any[]
  casinoOyunlari?: any[]
}>()

// Debug için props'ları console'a yazdır
console.log('HomeSelector props:', props)

// Mobil kontrol
const isMobile = ref(window.innerWidth < 1024)
const updateWidth = () => {
  isMobile.value = window.innerWidth < 1024
}
onMounted(() => window.addEventListener('resize', updateWidth))
onBeforeUnmount(() => window.removeEventListener('resize', updateWidth))
</script>
