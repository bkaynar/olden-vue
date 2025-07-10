<template>
  <div class="match-card">
    <!-- Header -->
    <div class="match-header">
      <img 
        v-if="flag" 
        :src="flag" 
        alt="flag" 
        class="flag-image" 
      />
      <span class="league-name">{{ league }}</span>
    </div>

    <!-- Main Content -->
    <div class="match-content">
      <!-- Teams -->
      <div class="teams-section">
        <span class="team-name">{{ homeTeam }}</span>
        <span class="team-name">{{ awayTeam }}</span>
      </div>

      <!-- Scores -->
      <div class="scores-section">
        <div class="score-row">
          <span class="score-main">{{ homeScore }}</span>
          <span class="score-half">({{ homeScoreHalf }})</span>
        </div>
        <div class="score-row">
          <span class="score-main">{{ awayScore }}</span>
          <span class="score-half">({{ awayScoreHalf }})</span>
        </div>
      </div>

      <!-- Status -->
      <div class="status-section">
        <span class="live-badge">LIVE</span>
        <span class="period-text">{{ period }}</span>
        <span class="minute-text">{{ minute }}'</span>
      </div>
    </div>

    <!-- Odds -->
    <div class="odds-section">
      <template v-for="(odd, idx) in odds" :key="idx">
        <div
          class="odd-card"
          :class="{ 'selected': selectedOdd === idx }"
          @click="selectOdd(odd, idx)"
        >
          <span class="odd-label">{{ odd.label }}</span>
          <span 
            class="odd-value"
            :class="{ 'highlighted': odd.highlight, 'selected-value': selectedOdd === idx }"
          >
            {{ odd.value }}
          </span>
          
          <!-- Selection indicator -->
          <div v-if="selectedOdd === idx" class="selection-indicator"></div>
          <div v-if="selectedOdd === idx" class="selection-dot"></div>
        </div>
      </template>
    </div>

    <!-- Live pulse indicator -->
    <div class="live-pulse"></div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, PropType, ref } from 'vue'

interface Odd {
  label: string
  value: string
  highlight?: boolean
}

const props = defineProps({
  flag: { type: String, default: '' },
  league: { type: String, default: 'Kulüp Dostluk' },
  homeTeam: { type: String, default: 'Phnom Penh Crown' },
  awayTeam: { type: String, default: 'ISI Dangkor Senchey FC' },
  homeScore: { type: [Number, String], default: 1 },
  awayScore: { type: [Number, String], default: 0 },
  homeScoreHalf: { type: [Number, String], default: 2 },
  awayScoreHalf: { type: [Number, String], default: 0 },
  period: { type: String, default: '2nd half' },
  minute: { type: [Number, String], default: 60 },
  odds: {
    type: Array as PropType<Odd[]>,
    default: () => [
      { label: '1', value: '2.01', highlight: false },
      { label: 'X', value: '2.54', highlight: false },
      { label: '2', value: '5.40', highlight: false }
    ]
  }
})

const selectedOdd = ref<number | null>(null)

const selectOdd = (odd: Odd, index: number) => {
  selectedOdd.value = selectedOdd.value === index ? null : index
  console.log('Selected odd:', odd)
  
  // Haptic feedback for mobile
  if ('vibrate' in navigator) {
    navigator.vibrate(50)
  }
}
</script>

<style scoped>
/* Main Card */
.match-card {
  width: 100%;
  max-width: 320px;
  min-width: 220px;
  height: 260px;
  background: linear-gradient(135deg, #1a232b 0%, #232a32 100%);
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  color: white;
  font-family: 'Inter', sans-serif;
  display: grid;
  grid-template-rows: auto 1fr auto;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.match-card:hover {
  border-color: rgba(255, 255, 255, 0.2);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.4),
    0 0 20px rgba(59, 130, 246, 0.1);
  transform: translateY(-2px);
}

/* Header */
.match-header {
  height: 40px;
  background: #232a32;
  padding: 0 12px;
  display: flex;
  align-items: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.flag-image {
  width: 16px;
  height: 12px;
  object-fit: cover;
  border-radius: 2px;
  margin-right: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

.league-name {
  font-size: 14px;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color: #e0e0e0;
}

/* Main Content */
.match-content {
  display: flex;
  padding: 16px 12px;
  justify-content: space-between;
  align-items: flex-start;
}

.teams-section {
  display: flex;
  flex-direction: column;
  gap: 4px;
  flex: 2;
}

.team-name {
  font-size: 14px;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  transition: color 0.2s ease;
}

.team-name:hover {
  color: #60a5fa;
}

.scores-section {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 4px;
  flex: 1;
  margin-left: 8px;
}

.score-row {
  display: flex;
  align-items: center;
  gap: 4px;
}

.score-main {
  font-size: 16px;
  font-weight: bold;
  color: #10b981;
}

.score-half {
  font-size: 12px;
  font-weight: 500;
  color: #9ca3af;
}

.status-section {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  margin-left: 8px;
  min-width: 40px;
}

.live-badge {
  font-size: 11px;
  font-weight: bold;
  background: #dc2626;
  padding: 2px 6px;
  border-radius: 4px;
  animation: pulse-live 2s infinite;
  box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
}

.period-text,
.minute-text {
  font-size: 12px;
  color: #9ca3af;
  font-weight: 500;
  margin-top: 2px;
}

/* Odds Section */
.odds-section {
  padding: 16px 12px;
  background: #232a32;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
  gap: 8px;
}

.odd-card {
  background: linear-gradient(135deg, #1e272f 0%, #262f38 100%);
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  padding: 8px;
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  border: 1px solid transparent;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.odd-card:hover {
  transform: translateY(-4px);
  box-shadow: 
    0 8px 25px rgba(0, 0, 0, 0.3),
    0 0 20px rgba(59, 130, 246, 0.15);
  border-color: rgba(59, 130, 246, 0.3);
  background: linear-gradient(135deg, #1e272f 0%, #2a3441 50%, #262f38 100%);
}

.odd-card:active {
  transform: translateY(-2px) scale(0.98);
}

.odd-card.selected {
  border-color: rgba(59, 130, 246, 0.5);
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
  box-shadow: 
    0 8px 25px rgba(0, 0, 0, 0.3),
    0 0 20px rgba(59, 130, 246, 0.25);
  transform: translateY(-4px);
  animation: glow 2s infinite;
}

.odd-label {
  font-size: 12px;
  text-transform: uppercase;
  color: #9ca3af;
  font-weight: 500;
  margin-bottom: 4px;
  transition: color 0.2s ease;
}

.odd-card:hover .odd-label {
  color: #60a5fa;
}

.odd-value {
  font-size: 18px;
  font-weight: bold;
  color: white;
  transition: all 0.2s ease;
}

.odd-card:hover .odd-value {
  color: #60a5fa;
  transform: scale(1.1);
}

.odd-value.highlighted {
  color: #fcd34d;
}

.odd-value.selected-value {
  color: #60a5fa;
}

/* Selection Indicators */
.selection-indicator {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 12px;
  height: 12px;
  background: #3b82f6;
  border-radius: 50%;
  animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.selection-dot {
  position: absolute;
  top: -4px;
  right: -4px;
  width: 12px;
  height: 12px;
  background: #60a5fa;
  border-radius: 50%;
}

/* Live Pulse Indicator */
.live-pulse {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 8px;
  height: 8px;
  background: #dc2626;
  border-radius: 50%;
  animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
  opacity: 0.75;
}

/* Ripple Effect */
.odd-card::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(59, 130, 246, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.odd-card:active::before {
  width: 300px;
  height: 300px;
}

/* Shimmer Effect */
.odd-card::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(
    45deg,
    transparent,
    rgba(255, 255, 255, 0.03),
    transparent
  );
  transform: rotate(45deg);
  transition: all 0.5s;
  opacity: 0;
}

.odd-card:hover::after {
  animation: shimmer 1.5s infinite;
}

/* Animations */
@keyframes pulse-live {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.7;
    transform: scale(1.05);
  }
}

@keyframes ping {
  75%, 100% {
    transform: scale(2);
    opacity: 0;
  }
}

@keyframes glow {
  0%, 100% {
    box-shadow: 
      0 8px 25px rgba(0, 0, 0, 0.3),
      0 0 5px rgba(59, 130, 246, 0.3);
  }
  50% {
    box-shadow: 
      0 8px 25px rgba(0, 0, 0, 0.3),
      0 0 20px rgba(59, 130, 246, 0.6);
  }
}

@keyframes shimmer {
  0% {
    transform: translateX(-100%) translateY(-100%) rotate(45deg);
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    transform: translateX(100%) translateY(100%) rotate(45deg);
    opacity: 0;
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .match-card {
    height: 280px;
  }
  
  .odd-card {
    padding: 6px;
  }
  
  .odd-card:active {
    transform: translateY(-1px) scale(0.95);
  }
}

/* Accessibility */
.odd-card:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}

/* Performance Optimizations */
.match-card,
.odd-card {
  transform: translateZ(0);
  backface-visibility: hidden;
}
</style>