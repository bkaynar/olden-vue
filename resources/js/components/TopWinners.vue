<template>
  <div class="relative overflow-hidden full-width rounded-borders q-pa-md p-4">
    <!-- Gradient overlays for fade effect -->
    <div class="absolute-left gradient-overlay-left"></div>
    <div class="absolute-right gradient-overlay-right"></div>
    
    <!-- Continuously scrolling winners tape -->
    <div 
      class="overflow-hidden"
      @mouseenter="isPaused = true"
      @mouseleave="isPaused = false"
    >
      <!-- Track (doubled list) -->
      <div
        class="row no-wrap items-center animate-track"
        :style="{
          animationPlayState: isPaused ? 'paused' : 'running',
          animationDuration: `${normalized.length * speed}s`,
        }"
      >
        <!-- Duplicate list twice so translateX(-50%) resets seamlessly -->
        <template v-for="repeat in 2" :key="repeat">
          <div
            v-for="(winner, idx) in normalized"
            :key="`${repeat}-${idx}`"
            class="winner-card"
          >
            <!-- Game Image -->
            <div class="game-image-container">
              <q-img
                :src="winner.gameImage || '/placeholder.svg?height=64&width=64'"
                :alt="winner.gameName"
                class="game-image"
                ratio="1"
                spinner-color="teal-4"
              >
                <div class="game-image-overlay"></div>
              </q-img>
            </div>

            <!-- Winner Info -->
            <div class="winner-info">
              <!-- Username with avatar -->
              <div class="username-row">
                <q-avatar size="20px" class="user-avatar">
                  <q-icon name="person" />
                </q-avatar>
                <span class="username-text">
                  {{ maskedUsername(winner.username) }}
                </span>
              </div>

              <!-- Game name -->
              <div class="game-name">
                {{ winner.gameName }}
              </div>

              <!-- Provider -->
              <div class="provider-name">
                {{ winner.provider }}
              </div>
            </div>

            <!-- Amount and Play Button -->
            <div class="winner-actions">
              <!-- Amount -->
              <div class="amount-section">
                <div class="amount-value">
                  ₺{{ winner.amount.toLocaleString('tr-TR', { minimumFractionDigits: 2 }) }}
                </div>
                <div class="amount-label">
                  Kazanç
                </div>
              </div>

              <!-- Play Button -->
              <q-btn
                round
                dense
                icon="play_arrow"
                size="sm"
                class="play-button"
                @click="onPlay(winner)"
              />
            </div>

            <!-- Hover glow effect -->
            <div class="hover-glow"></div>
          </div>
        </template>
      </div>
    </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, defineProps } from 'vue'
import { QImg, QIcon, QBtn, QAvatar } from 'quasar'

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

const maskedUsername = (u = '') => 
  u.length < 4 ? u : `${u.slice(0, 1)}***${u.slice(-2)}`

const normalized = computed(() =>
  props.lastWinners.map(w => ({
    username: w.username || 'Anonim',
    gameName: w.gameName || w.game_name || 'Bilinmeyen Oyun',
    provider: w.provider || 'Bilinmeyen',
    amount: Number(w.amount) || 0,
    gameImage: w.gameImage || w.cover || '',
  })),
)

// Seconds per card – lower => faster scroll
const speed = 0.5
const isPaused = ref(false)

const onPlay = (winner: any) => {
  console.log('Play', winner)
  // Add haptic feedback for mobile
  if ('vibrate' in navigator) {
    navigator.vibrate(50)
  }
}
</script>

<style scoped>
/* Container Styles */
.bg-dark {
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
}

/* Gradient Overlays */
.gradient-overlay-left {
  top: 0;
  bottom: 0;
  left: 0;
  width: 80px;
  background: linear-gradient(to right, #1a1a2e, transparent);
  z-index: 10;
  pointer-events: none;
}

.gradient-overlay-right {
  top: 0;
  bottom: 0;
  right: 0;
  width: 80px;
  background: linear-gradient(to left, #1a1a2e, transparent);
  z-index: 10;
  pointer-events: none;
}

/* Winner Card */
.winner-card {
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 16px;
  margin-right: 16px;
  min-width: 340px;
  max-width: 380px;
  height: 100px;
  position: relative;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.winner-card:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(0, 255, 136, 0.3);
  transform: translateY(-2px);
  box-shadow: 0 8px 32px rgba(0, 255, 136, 0.15);
}

/* Game Image */
.game-image-container {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  margin-right: 16px;
}

.game-image {
  width: 64px;
  height: 64px;
  border-radius: 12px;
  border: 2px solid rgba(255, 255, 255, 0.1);
  transition: transform 0.3s ease;
}

.winner-card:hover .game-image {
  transform: scale(1.1);
}

.game-image-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.2), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.winner-card:hover .game-image-overlay {
  opacity: 1;
}

/* Winner Info */
.winner-info {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.username-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.user-avatar {
  background: rgba(255, 255, 255, 0.1);
  color: #00ff88;
}

.username-text {
  font-size: 12px;
  color: #e0e0e0;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.game-name {
  color: white;
  font-size: 14px;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  transition: color 0.3s ease;
}

.winner-card:hover .game-name {
  color: #00ff88;
}

.provider-name {
  color: #a0a0a0;
  font-size: 12px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Winner Actions */
.winner-actions {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-between;
  height: 100%;
  gap: 8px;
}

.amount-section {
  text-align: right;
}

.amount-value {
  color: #00ff88;
  font-size: 18px;
  font-weight: bold;
  line-height: 1.2;
  transition: all 0.3s ease;
}

.winner-card:hover .amount-value {
  background: linear-gradient(45deg, #00ff88, #00d4aa);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.amount-label {
  font-size: 10px;
  color: #888;
  font-weight: 500;
}

.play-button {
  background: rgba(0, 255, 136, 0.2);
  color: #00ff88;
  border: 1px solid rgba(0, 255, 136, 0.3);
  transition: all 0.3s ease;
}

.play-button:hover {
  background: rgba(0, 255, 136, 0.3);
  color: #00d4aa;
  border-color: rgba(0, 255, 136, 0.5);
  transform: scale(1.1) rotate(5deg);
  box-shadow: 0 4px 16px rgba(0, 255, 136, 0.25);
}

/* Hover Glow Effect */
.hover-glow {
  position: absolute;
  inset: 0;
  border-radius: 16px;
  background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.05), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.winner-card:hover .hover-glow {
  opacity: 1;
}

/* Live Indicator */
.live-indicator {
  position: absolute;
  top: 16px;
  left: 16px;
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 0, 0, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 6px 12px;
  border: 1px solid rgba(255, 0, 0, 0.3);
}

.live-dot {
  width: 8px;
  height: 8px;
  background: #ff0000;
  border-radius: 50%;
  animation: pulse 2s infinite;
}

.live-text {
  color: #ff4444;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.5px;
}

/* Winners Count */
.winners-count {
  position: absolute;
  top: 16px;
  right: 16px;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 6px 12px;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.count-text {
  color: #e0e0e0;
  font-size: 11px;
  font-weight: 500;
}

/* Animations */
@keyframes slide-left {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.animate-track {
  animation-name: slide-left;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
  will-change: transform;
  backface-visibility: hidden;
}

/* Responsive */
@media (max-width: 600px) {
  .winner-card {
    min-width: 300px;
    max-width: 320px;
    height: 90px;
    padding: 12px;
  }
  
  .game-image {
    width: 48px;
    height: 48px;
  }
  
  .game-image-container {
    margin-right: 12px;
  }
  
  .amount-value {
    font-size: 16px;
  }
}

/* Accessibility */
.winner-card:focus-within {
  outline: 2px solid #00ff88;
  outline-offset: 2px;
}

/* Performance optimizations */
.winner-card,
.game-image,
.play-button {
  transform: translateZ(0);
}
</style>