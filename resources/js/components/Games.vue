<template>
  <div class="q-pa-md bg-gradient-dark rounded-borders">
    <!-- tabs + sağda tümünü gör butonu -->
    <div class="row items-center justify-between q-mb-lg">
      <div class="row q-gutter-sm">
        <q-btn v-for="c in categories" :key="c.key" rounded :flat="activeTab !== c.key"
          :color="activeTab === c.key ? 'primary' : 'grey-7'" :text-color="activeTab === c.key ? 'white' : 'grey-4'"
          :label="c.label" @click="activeTab = c.key" class="modern-tab-btn"
          :class="{ 'active-tab': activeTab === c.key }" />
      </div>
      <q-btn flat rounded dense class="view-all-btn" label="Tümünü Gör" icon-right="arrow_forward" />
    </div>

    <!-- grid list, sadece 5 oyun -->
    <div class="row q-gutter-lg justify-start">
      <template v-if="filteredGames.length > 0">
        <div v-for="(game, idx) in filteredGames.slice(0, 5)" :key="idx"
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
            <q-icon name="play_arrow" slot="prepend" />
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
  </div>
</template>

<script setup lang="ts">
import { ref, computed, defineProps, watch } from 'vue'
import { QIcon, QBtn } from 'quasar'

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

// Eğer dışarıdan prop gelmiyorsa örnek veri kullan
const fallbackGames: Game[] = [
  { name: 'Gates of Olympus', provider: 'Pragmatic Play', isNew: true, highRtp: true, popular: true, category: 'Popüler' },
  { name: 'Sweet Bonanza', provider: 'Pragmatic Play', isNew: false, highRtp: true, popular: true, category: 'Popüler' },
  { name: 'Wolf Gold', provider: 'Pragmatic Play', isNew: false, highRtp: false, popular: true, category: 'Popüler' },
  { name: 'Aztec Gems', provider: 'Pragmatic Play', isNew: true, highRtp: false, popular: true, category: 'Popüler' },
  { name: 'Lucky Lady\'s Charm', provider: 'Novomatic', isNew: false, highRtp: false, popular: true, category: 'Popüler' },
  { name: 'Book of Ra', provider: 'Novomatic', isNew: false, highRtp: false, popular: true, category: 'planor' },
  { name: 'Starburst', provider: 'NetEnt', isNew: false, highRtp: false, popular: true, category: 'planor' },
  { name: 'Mega Moolah', provider: 'Microgaming', isNew: false, highRtp: true, popular: true, category: 'planor' },
  { name: 'Mega Moolah', provider: 'Microgaming', isNew: false, highRtp: true, popular: true, category: 'planor' },

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

/* Responsive design */
@media (max-width: 768px) {
  .modern-game-card {
    width: 140px;
    height: 140px;
  }

  .modern-play-btn {
    min-width: 75px;
    /* Biraz daha geniş */
    height: 28px;
    /* Biraz daha düşük */
    font-size: 12px;
    border-radius: 4px;
    /* Daha az yuvarlatılmış */
  }
}
</style>