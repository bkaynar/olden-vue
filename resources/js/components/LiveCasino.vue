<template>
    <div class="q-pa-md rounded-borders">
        <!-- Desktop grid -->
        <div v-if="!isMobile" class="row q-gutter-lg justify-center">
            <template v-if="gamesToShow.length > 0">
                <div v-for="(game, idx) in showAll ? gamesToShow : gamesToShow.slice(0, 6)" :key="idx"
                    class="modern-game-card relative flex items-center justify-center overflow-hidden group"
                    @mouseenter="hovered = idx" @mouseleave="hovered = null">
                    <div class="card-gradient"></div>
                    <img v-if="game.cover" :src="game.cover" alt="Game Cover" class="game-cover-img" />
                    <q-icon v-else name="mdi-gamepad-variant" size="48px" color="grey-5" class="game-icon" />
                    <q-btn class="modern-play-btn absolute" color="primary" text-color="white" size="sm" no-caps
                        :class="{ 'show': hovered === idx }">
                        <q-icon name="play_arrow" />
                        Oyna
                    </q-btn>
                    <div class="modern-hover-overlay" :class="{ 'show': hovered === idx }"></div>
                </div>
            </template>
            <template v-else>
                <div class="text-grey-4 q-pa-md">Oyun bulunamadı.</div>
            </template>
        </div>
        <!-- Mobile Swiper carousel -->
        <div v-else>
            <template v-if="gamesToShow.length > 0">
                <div class="swiper-container">
                    <!-- Navigation butonları: LiveCasino'ya özel class'lar SADECE -->
                    <div :id="`${uniqueSwiperId}-prev`" class="livecasino-nav-prev"></div>
                    <div :id="`${uniqueSwiperId}-next`" class="livecasino-nav-next"></div>
                    <swiper :modules="modules" :slides-per-view="'auto'" :centered-slides="true" :space-between="20"
                        :initial-slide="0" :loop="true" :navigation="{
                            nextEl: `#${uniqueSwiperId}-next`,
                            prevEl: `#${uniqueSwiperId}-prev`,
                        }" class="livecasino-swiper" @swiper="onSwiper" @slide-change="onSlideChange">
                        <swiper-slide v-for="(game, idx) in showAll ? gamesToShow : gamesToShow.slice(0, 6)" :key="idx"
                            class="game-slide">
                            <div class="modern-game-card-mobile relative flex items-center justify-center overflow-hidden"
                                :class="{ 'active-card': activeSlideIndex === idx, 'side-card': activeSlideIndex !== idx }">
                                <div class="card-gradient"></div>
                                <img v-if="game.cover" :src="game.cover" alt="Game Cover" class="game-cover-img" />
                                <q-icon v-else name="mdi-gamepad-variant" size="48px" color="grey-5"
                                    class="game-icon" />
                                <q-btn v-if="activeSlideIndex === idx" class="modern-play-btn absolute show"
                                    color="primary" text-color="white" size="sm" no-caps>
                                    <q-icon name="play_arrow" />
                                    Oyna
                                </q-btn>
                            </div>
                        </swiper-slide>
                    </swiper>
                </div>
            </template>
            <template v-else>
                <div class="text-grey-4 q-pa-md text-center">Oyun bulunamadı.</div>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted, onUnmounted } from 'vue'
import { QIcon, QBtn } from 'quasar'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, EffectCoverflow } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/effect-coverflow'

function generateUniqueId() {
    return 'livecasino-swiper-' + Math.random().toString(36).substr(2, 9)
}

interface Game {
    cover?: string
}

const props = defineProps<{ games?: Game[] }>()
const hovered = ref<number | null>(null)
const showAll = ref(false)
const gamesToShow = props.games && props.games.length > 0 ? props.games : []
const isMobile = ref(false)
const activeSlideIndex = ref(0)
const modules = [Navigation, Pagination, EffectCoverflow]
const swiperInstance = ref<any>(null)
const uniqueSwiperId = ref(generateUniqueId())
const onSwiper = (swiper: any) => {
    swiperInstance.value = swiper
}
const onSlideChange = (swiper: any) => {
    activeSlideIndex.value = swiper.realIndex
}
const checkScreenSize = () => {
    isMobile.value = window.innerWidth <= 768
}
onMounted(() => {
    checkScreenSize()
    window.addEventListener('resize', checkScreenSize)
})
onUnmounted(() => {
    window.removeEventListener('resize', checkScreenSize)
})
</script>

<style scoped>
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

.modern-game-card-mobile {
    width: 160px;
    height: 250px;
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

.modern-game-card-mobile.active-card {
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    border-color: rgba(102, 126, 234, 0.6);
    background: rgba(255, 255, 255, 0.08);
}

.modern-game-card-mobile.side-card {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    border-color: rgba(255, 255, 255, 0.05);
    background: rgba(255, 255, 255, 0.02);
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

.game-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.swiper-container {
    position: relative;
    width: 100%;
    height: 270px;
    padding: 20px 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.livecasino-swiper {
    width: 100%;
    height: 100%;
    overflow: visible;
    padding: 0 80px;
}

.swiper-wrapper {
    align-items: center;
}

.game-slide {
    width: 100% !important;
    max-width: 240px;
    margin: auto;
}

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

/* LiveCasino Navigation Buttons - TAMAMEN AYRI CLASS'LAR */
.livecasino-nav-prev,
.livecasino-nav-next {
    position: absolute;
    top: 50%;
    width: 40px;
    height: 40px;
    margin-top: -20px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transition: all 0.3s ease;
    z-index: 10;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.livecasino-nav-prev::after {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 6px 10px 6px 0;
    border-color: transparent #e0e0e0 transparent transparent;
}

.livecasino-nav-next::after {
    content: '';
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 6px 0 6px 10px;
    border-color: transparent transparent transparent #e0e0e0;
}

.livecasino-nav-prev:hover,
.livecasino-nav-next:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.05);
    border-color: rgba(102, 126, 234, 0.4);
}

.livecasino-nav-prev:hover::after {
    border-color: transparent #fff transparent transparent;
}

.livecasino-nav-next:hover::after {
    border-color: transparent transparent transparent #fff;
}

.livecasino-nav-prev {
    left: 20px;
}

.livecasino-nav-next {
    right: 20px;
}

@media (max-width: 768px) {

    .modern-game-card,
    .modern-game-card-mobile {
        width: 140px;
        height: 187px;
    }

    .modern-play-btn {
        min-width: 75px;
        height: 28px;
        font-size: 12px;
        border-radius: 4px;
    }

    .swiper-container {
        height: 210px;
    }
}
</style>
