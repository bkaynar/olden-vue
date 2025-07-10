<template>
    <div class="q-pa-md rounded-borders">
        <div class="row q-guGter-lg justify-start">
            <template v-if="gamesToShow.length > 0">
                <div v-for="(game, idx) in showAll ? gamesToShow : gamesToShow.slice(0, 6)" :key="idx"
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
                        <q-icon name="play_arrow" />
                        Oyna
                    </q-btn>
                    <!-- Hover overlay -->
                    <div class="modern-hover-overlay" :class="{ 'show': hovered === idx }"></div>
                </div>
            </template>
            <template v-else>
                <div class="text-grey-4 q-pa-md">Oyun bulunamadı.</div>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, defineProps } from 'vue'
import { QIcon, QBtn } from 'quasar'

interface Game {
    cover?: string
}

const props = defineProps<{ games?: Game[] }>()
const hovered = ref<number | null>(null)
const showAll = ref(false)
const gamesToShow = props.games && props.games.length > 0 ? props.games : []
</script>

<style scoped>
/* Birebir Games.vue'dan kopyalanan stiller */
.card-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}


.modern-game-card {
    width: 160px;
    height: 250px;
    /* 160 * 4 / 3 = 213.33... */
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
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
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    min-width: 85px;
    height: 32px;
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

.row.q-guGter-lg,
.row.q-gutter-lg {
    gap: 24px;
}

@media (max-width: 768px) {
    .modern-game-card {
        width: 140px;
        height: 187px;
        /* 140 * 4 / 3 = 186.66... */
    }

    .modern-play-btn {
        min-width: 75px;
        height: 28px;
        font-size: 12px;
        border-radius: 4px;
    }
}
</style>
