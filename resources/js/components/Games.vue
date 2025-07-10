<template>
  <div class="q-pa-md rounded-borders">
    <!-- tabs + sağda tümünü gör butonu -->
    <div class="row items-center justify-between q-mb-lg">
      <!-- Kategorileri sadece desktop'ta göster -->
      <div v-if="!isMobile" class="row q-gutter-sm">
        <q-btn v-for="c in categories" :key="c.key" rounded :flat="activeTab !== c.key"
          :color="activeTab === c.key ? 'primary' : 'grey-7'" :text-color="activeTab === c.key ? 'white' : 'grey-4'"
          :label="c.label" @click="activeTab = c.key" class="modern-tab-btn"
          :class="{ 'active-tab': activeTab === c.key }" />
      </div>
      <!-- Mobilde boş div -->
      <div v-else></div>

      <!-- Tümünü Gör butonunu sadece desktop'ta göster -->
      <q-btn v-if="!isMobile" flat rounded dense class="view-all-btn" label="Tümünü Gör" icon-right="arrow_forward" />
    </div>

    <!-- Desktop: grid list, Mobile: carousel -->
    <!-- Desktop grid -->
    <div v-if="!isMobile" class="row q-gutter-lg justify-start">
      <template v-if="filteredGames.length > 0">
        <div v-for="(game, idx) in filteredGames.slice(0, 6)" :key="idx"
          class="modern-game-card relative flex items-center justify-center overflow-hidden group"
          @mouseenter="hovered = idx" @mouseleave="hovered = null">
          <!-- Background gradient -->
          <div class="card-gradient"></div>

          <!-- Oyun görseli (cover) -->
          <img v-if="game.cover" :src="game.cover" alt="Game Cover" class="game-cover-img" />
          <!-- Placeholder icon, cover yoksa -->
          <q-icon v-else name="mdi-gamepad-variant" size="48px" color="grey-5" class="game-icon" />

          <!-- Play button -->
          <q-btn class="modern-play-btn absolute" color="primary" text-color="white" size="sm" no-caps
            :class="{ 'show': hovered === idx }">
            <!-- Sol tarafa icon -->
            <template #prepend>
              <q-icon name="play_arrow" />
            </template>
            <!-- Yanına metin -->
            Oyna
          </q-btn>
          <!-- Hover overlay -->
          <div class="modern-hover-overlay" :class="{ 'show': hovered === idx }"></div>

          <!-- Game info overlay -->
          <div class="game-info absolute bottom-0 left-0 right-0 p-2" :class="{ 'show': hovered === idx }">
            <div class="text-white text-weight-medium text-caption">{{ game.name }}</div>
            <div class="text-grey-4 text-caption">{{ game.provider }}</div>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="text-grey-4 q-pa-md">Oyun bulunamadı.</div>
      </template>
    </div>

    <!-- Mobile carousel -->
    <div v-else>
      <template v-if="filteredGames.length > 0">
        <!-- Swiper carousel -->
        <div class="swiper-container">
          <swiper
            :modules="modules"
            :slides-per-view="'auto'"
            :centered-slides="true"
            :space-between="20"
            :initial-slide="0"
            :loop="true"
            :navigation="{
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            }"
            class="games-swiper"
            @swiper="onSwiper"
            @slide-change="onSlideChange"
          >
            <swiper-slide v-for="(game, idx) in filteredGames.slice(0, 6)" :key="idx" class="game-slide">
              <div class="modern-game-card-mobile relative flex items-center justify-center overflow-hidden"
                :class="{ 'active-card': activeSlideIndex === idx, 'side-card': activeSlideIndex !== idx }">
                <!-- Background gradient -->
                <div class="card-gradient"></div>

                <!-- Oyun görseli (cover) -->
                <img v-if="game.cover" :src="game.cover" alt="Game Cover" class="game-cover-img" />
                <!-- Placeholder icon, cover yoksa -->
                <q-icon v-else name="mdi-gamepad-variant" size="48px" color="grey-5" class="game-icon" />

                <!-- Play button - sadece aktif card'da göster -->
                <q-btn v-if="activeSlideIndex === idx" class="modern-play-btn absolute show" color="primary"
                  text-color="white" size="sm" no-caps>
                  <!-- Sol tarafa icon -->
                  <template #prepend>
                    <q-icon name="play_arrow" />
                  </template>
                  <!-- Yanına metin -->
                  Oyna
                </q-btn>

                <!-- Game info overlay - sadece aktif card'da göster -->
                <div v-if="activeSlideIndex === idx" class="game-info absolute bottom-0 left-0 right-0 p-2 show">
                  <div class="text-white text-weight-medium text-caption">{{ game.name }}</div>
                  <div class="text-grey-4 text-caption">{{ game.provider }}</div>
                </div>
              </div>
            </swiper-slide>
          </swiper>

          <!-- Custom Navigation Buttons -->
          <div class="swiper-button-prev custom-nav-btn"></div>
          <div class="swiper-button-next custom-nav-btn"></div>
        </div>
      </template>
      <template v-else>
        <div class="text-grey-4 q-pa-md text-center">Oyun bulunamadı.</div>
      </template>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, defineProps, watch, onMounted, onUnmounted } from 'vue'
import { QIcon, QBtn } from 'quasar'
// Swiper imports
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, EffectCoverflow } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/effect-coverflow'

interface Game {
  name: string
  provider: string
  category: string
  isNew?: boolean
  highRtp?: boolean
  popular?: boolean
  cover?: string // cover alanı eklendi
}

const props = defineProps<{ games?: Game[] }>()

const hovered = ref<number | null>(null)
const activeSlideIndex = ref(0) // Aktif slide index'i
const isMobile = ref(false)

// Swiper modules
const modules = [Navigation, Pagination, EffectCoverflow]

// Swiper instance referansı
const swiperInstance = ref<any>(null)

// Swiper event handlers
const onSwiper = (swiper: any) => {
  swiperInstance.value = swiper
}

const onSlideChange = (swiper: any) => {
  activeSlideIndex.value = swiper.realIndex
}

// Ekran boyutunu kontrol et
const checkScreenSize = () => {
  isMobile.value = window.innerWidth <= 768
}

// Component mount olunca ve resize olunca kontrol et
onMounted(() => {
  checkScreenSize()
  window.addEventListener('resize', checkScreenSize)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreenSize)
})

// Eğer dışarıdan prop gelmiyorsa örnek veri kullan
const fallbackGames: Game[] = [
  { name: 'Gates of Olympus', provider: 'Pragmatic Play', isNew: true, highRtp: true, popular: true, category: 'Popüler', cover: 'https://picsum.photos/200/200?random=1' },
  { name: 'Sweet Bonanza', provider: 'Pragmatic Play', isNew: false, highRtp: true, popular: true, category: 'Popüler', cover: 'https://picsum.photos/200/200?random=2' },
  { name: 'Wolf Gold', provider: 'Pragmatic Play', isNew: false, highRtp: false, popular: true, category: 'Popüler', cover: 'https://picsum.photos/200/200?random=3' },
  { name: 'Aztec Gems', provider: 'Pragmatic Play', isNew: true, highRtp: false, popular: true, category: 'Popüler', cover: 'https://picsum.photos/200/200?random=4' },
  { name: 'Lucky Lady\'s Charm', provider: 'Novomatic', isNew: false, highRtp: false, popular: true, category: 'Popüler', cover: 'https://picsum.photos/200/200?random=5' },
  { name: 'Book of Ra', provider: 'Novomatic', isNew: false, highRtp: false, popular: true, category: 'planor', cover: 'https://picsum.photos/200/200?random=6' },
  { name: 'Starburst', provider: 'NetEnt', isNew: false, highRtp: false, popular: true, category: 'planor', cover: 'https://picsum.photos/200/200?random=7' },
  { name: 'Mega Moolah', provider: 'Microgaming', isNew: false, highRtp: true, popular: true, category: 'planor', cover: 'https://picsum.photos/200/200?random=8' },
  { name: 'John Hunter', provider: 'Pragmatic Play', isNew: false, highRtp: true, popular: true, category: 'planor', cover: 'https://picsum.photos/200/200?random=9' },
]

// Dinamik kategoriler
const categories = computed(() => {
  const list = props.games && props.games.length > 0 ? props.games : fallbackGames
  const unique = Array.from(new Set(list.map(g => g.category).filter(Boolean)))
  const cats = unique.map(key => ({ key, label: key ? key.charAt(0).toUpperCase() + key.slice(1) : 'Diğer' }))
  return [{ key: 'all', label: 'Tümü' }, ...cats]
})

const activeTab = ref('all')

// Kategori değişirse ilk kategoriye setle
watch(categories, (newVal) => {
  if (newVal.length > 0) activeTab.value = newVal[0].key
})

const filteredGames = computed(() => {
  const list = props.games && props.games.length > 0 ? props.games : fallbackGames
  if (!activeTab.value || activeTab.value === 'all') return list
  return list.filter(g => g.category === activeTab.value)
})
</script>

<style scoped>
.bg-gradient-dark {
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
}

.modern-tab-btn {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.modern-tab-btn.active-tab {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
  transform: translateY(-1px);
}

.view-all-btn {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #e0e0e0;
  transition: all 0.3s ease;
  min-width: 160px;
  height: 40px;
  /* Sabit yükseklik ekledik */
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 8px 16px !important;
  /* Padding'i tamamen sıfırlamak yerine uygun değer verdik */
  text-align: center;
}

.view-all-btn .q-btn__content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  /* İkon ve metin arasında boşluk */
}

.view-all-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  transform: translateX(4px);
}

.modern-game-card {
  width: 160px;
  height: 160px;
  border-radius: 20px;
  position: relative;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  overflow: hidden;
}

.card-gradient {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.modern-game-card:hover {
  transform: translateY(-8px) scale(1.05);
  box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
  border-color: rgba(102, 126, 234, 0.5);
}

.modern-game-card:hover .card-gradient {
  opacity: 1;
}

.game-icon {
  transition: all 0.3s ease;
  z-index: 1;
}

.modern-game-card:hover .game-icon {
  transform: scale(0.8);
  opacity: 0.6;
}

.modern-play-btn {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.8);
  z-index: 3;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 6px;
  /* 12px'den 6px'e düşürüldü */
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
  min-width: 85px;
  /* Biraz daha geniş */
  height: 32px;
  /* Biraz daha düşük */
  font-weight: 600;
  letter-spacing: 0.5px;
}

.modern-play-btn.show {
  opacity: 1;
  pointer-events: auto;
  transform: translate(-50%, -50%) scale(1);
}

.modern-play-btn:hover {
  transform: translate(-50%, -50%) scale(1.05);
  box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
}

.modern-hover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 2;
}

.modern-hover-overlay.show {
  opacity: 1;
}

.game-info {
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
  transform: translateY(100%);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 4;
}

.game-info.show {
  transform: translateY(0);
}

.game-cover-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
}

/* Swiper Carousel Styles */
.swiper-container {
  position: relative;
  width: 100%;
  height: 220px;
  padding: 20px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.games-swiper {
  width: 100%;
  height: 100%;
  overflow: visible;
  padding: 0 80px;
  /* Sağ sol padding ekleyip merkezleme */
}

.swiper-wrapper {
  align-items: center;
}

.game-slide {
  width: 100% !important;
  max-width: 240px;
  margin: auto;
}

/* Swiper slide efektleri */
.swiper-slide:not(.swiper-slide-active) {
  opacity: 0.6;
  transform: scale(0.8);
  filter: grayscale(0.3);
}

.swiper-slide.swiper-slide-active {
  opacity: 1;
  transform: scale(1);
  filter: grayscale(0);
  z-index: 3;
}

.modern-game-card-mobile {
  width: 160px;
  height: 160px;
  border-radius: 20px;
  position: relative;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  overflow: hidden;
  margin: 0 auto;
}

/* Aktif card için ek efektler */
.modern-game-card-mobile.active-card {
  box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
  border-color: rgba(102, 126, 234, 0.6);
  background: rgba(255, 255, 255, 0.08);
}

/* Yan taraftaki cardlar */
.modern-game-card-mobile.side-card {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  border-color: rgba(255, 255, 255, 0.05);
  background: rgba(255, 255, 255, 0.02);
}

.modern-game-card-mobile:active {
  transform: scale(0.95);
}

/* Swiper Navigation Buttons */
.custom-nav-btn {
  width: 40px;
  height: 40px;
  margin-top: -20px;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transition: all 0.3s ease;
  z-index: 10;
}

.custom-nav-btn:after {
  font-size: 16px;
  font-weight: bold;
  color: #e0e0e0;
}

.custom-nav-btn:hover {
  background: rgba(255, 255, 255, 0.25);
  transform: scale(1.05);
  border-color: rgba(102, 126, 234, 0.4);
}

.custom-nav-btn.swiper-button-disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.swiper-button-prev.custom-nav-btn {
  left: 20px;
}

.swiper-button-next.custom-nav-btn {
  right: 20px;
}
</style>