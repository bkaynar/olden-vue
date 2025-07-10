<template>
  <div class="q-pa-sm bg-dark rounded-borders relative overflow-hidden full-width select-none">
    <!-- continuously-scrolling winners tape -->
    <div
      class="overflow-hidden"
      @mouseenter="isPaused = true"
      @mouseleave="isPaused = false"
    >
      <!-- track (doubled list) -->
      <div
        class="row no-wrap items-center animate-track"
        :style="{
          animationPlayState: isPaused ? 'paused' : 'running',
          animationDuration: `${normalized.length * speed}s`,
        }"
      >
        <!-- duplicate list twice so translateX(-50%) resets seamlessly -->
        <template v-for="repeat in 2" :key="repeat">
          <div
            v-for="(winner, idx) in normalized"
            :key="`${repeat}-${idx}`"
            class="winner-card row items-center no-wrap bg-grey-10 q-pa-sm q-mr-sm rounded-borders shadow-4"
          >
            <q-img
              :src="winner.gameImage"
              :alt="winner.gameName"
              class="img-game q-mr-md"
              ratio="1"
              spinner-color="cyan-4"
            />
            <div class="column justify-between q-mr-md" style="min-width: 0; flex: 1;">
              <div class="row items-center q-gutter-xs q-mb-xs">
                <q-avatar size="24px" color="grey-8" text-color="green-4">
                  <q-icon name="mdi-account" />
                </q-avatar>
                <span class="text-xs text-grey-2 ellipsis">
                  {{ maskedUsername(winner.username) }}
                </span>
              </div>
              <div class="text-weight-bold text-white ellipsis">
                {{ winner.gameName }}
              </div>
              <div class="text-cyan-3 text-xs ellipsis">
                {{ winner.provider }}
              </div>
            </div>
            <div class="column items-end justify-between self-stretch">
              <span class="text-green-4 text-subtitle1 text-weight-bolder">
                ₺{{ winner.amount.toLocaleString('tr-TR', { minimumFractionDigits: 2 }) }}
              </span>
              <q-btn
                flat round dense
                icon="mdi-play"
                size="sm"
                class="bg-grey-9 text-green-4 border-green-4"
                @click="onPlay(winner)"
              />
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, defineProps } from 'vue'
import { QImg, QAvatar, QIcon, QBtn } from 'quasar'

interface WinnerRaw {
  username?: string
  gameName?: string
  game_name?: string
  provider?: string
  amount?: number | string
  gameImage?: string
  cover?: string
}

const props = defineProps<{ lastWinners: WinnerRaw[] }>()

const maskedUsername = (u = '') => (u.length < 4 ? u : `${u.slice(0, 2)}***${u.slice(-2)}`)

const normalized = computed(() =>
  props.lastWinners.map(w => ({
    username: w.username || '-',
    gameName: w.gameName || w.game_name || '-',
    provider: w.provider || '-',
    amount: Number(w.amount) || 0,
    gameImage: w.gameImage || w.cover || '',
  })),
)

// seconds per card – lower => faster scroll
const speed = 4
const isPaused = ref(false)
const onPlay = (winner: any) => console.log('Play', winner)
</script>

<style scoped>
.winner-card {
  min-width: 320px;
  max-width: 420px;
  height: 96px;
}
.img-game {
  width: 64px;
  height: 64px;
  border-radius: 12px;
}
/* continuous scroll keyframes */
@keyframes slide-left {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}
.animate-track {
  animation-name: slide-left;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}
</style>