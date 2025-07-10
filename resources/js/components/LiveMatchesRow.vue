<template>
    <div>
        <!-- Mobile: Carousel -->
        <div v-if="isMobile">
            <div class="relative overflow-hidden w-full">
                <!-- Sol Nav Butonu -->
                <button 
                    @click="prev"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all duration-200 backdrop-blur-sm"
                    :class="{ 'opacity-50 cursor-not-allowed': currentIndex === 0 }"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Sağ Nav Butonu -->
                <button 
                    @click="next"
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all duration-200 backdrop-blur-sm"
                    :class="{ 'opacity-50 cursor-not-allowed': currentIndex === matches.length - 1 }"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <div 
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="{ 
                        transform: `translateX(-${currentIndex * (100 / matches.length)}%)`,
                        width: `${matches.length * 100}%`
                    }"
                >
                    <div 
                        v-for="(match, idx) in matches" 
                        :key="idx" 
                        class="flex-shrink-0 flex justify-center items-center px-4"
                        :style="{ width: `${100 / matches.length}%` }"
                    >
                        <LiveMatchCard 
                            v-bind="match" 
                            class="w-full max-w-[320px] min-w-[280px] h-[260px]" 
                        />
                    </div>
                </div>
            </div>
            
            <!-- Carousel Dots -->
            <div class="flex justify-center mt-4 gap-2">
                <button 
                    v-for="(match, idx) in matches" 
                    :key="'dot-' + idx" 
                    class="w-2 h-2 rounded-full transition-colors duration-200"
                    :class="currentIndex === idx ? 'bg-white' : 'bg-gray-500'" 
                    @click="goTo(idx)"
                ></button>
            </div>
        </div>

        <!-- Desktop: Grid -->
        <div v-else>
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 justify-items-center">
                <LiveMatchCard 
                    v-for="(match, idx) in matches" 
                    :key="idx" 
                    v-bind="match"
                    class="w-full max-w-[320px] min-w-[220px] h-[260px] md:h-[280px]" 
                />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import LiveMatchCard from './LiveMatchCard.vue'

interface Odd {
    label: string
    value: string
    highlight?: boolean
}

interface Match {
    flag?: string
    league: string
    homeTeam: string
    awayTeam: string
    homeScore: number | string
    awayScore: number | string
    homeScoreHalf?: number | string
    awayScoreHalf?: number | string
    period: string
    minute: number | string
    odds: Odd[]
}

const props = defineProps<{ matches?: Match[] }>()

const defaultMatches: Match[] = [
    {
        league: 'Kulüp Dostluk',
        homeTeam: 'Phnom Penh Crown',
        awayTeam: 'ISI Dangkor Senchey FC',
        homeScore: 1,
        awayScore: 0,
        homeScoreHalf: 2,
        awayScoreHalf: 0,
        period: '2nd half',
        minute: 60,
        odds: [
            { label: '1', value: '2.01' },
            { label: 'X', value: '2.54' },
            { label: '2', value: '5.40' }
        ]
    },
    {
        league: 'Süper Lig',
        homeTeam: 'Galatasaray',
        awayTeam: 'Fenerbahçe',
        homeScore: 2,
        awayScore: 2,
        homeScoreHalf: 1,
        awayScoreHalf: 1,
        period: '1st half',
        minute: 38,
        odds: [
            { label: '1', value: '1.85' },
            { label: 'X', value: '3.10' },
            { label: '2', value: '4.20' }
        ]
    },
    {
        league: 'Premier League',
        homeTeam: 'Manchester United',
        awayTeam: 'Chelsea',
        homeScore: 0,
        awayScore: 1,
        homeScoreHalf: 0,
        awayScoreHalf: 0,
        period: '2nd half',
        minute: 72,
        odds: [
            { label: '1', value: '2.40' },
            { label: 'X', value: '2.90' },
            { label: '2', value: '2.80' }
        ]
    },
    {
        league: 'Serie A',
        homeTeam: 'Juventus',
        awayTeam: 'Inter',
        homeScore: 1,
        awayScore: 3,
        homeScoreHalf: 0,
        awayScoreHalf: 2,
        period: '2nd half',
        minute: 80,
        odds: [
            { label: '1', value: '5.00' },
            { label: 'X', value: '3.50' },
            { label: '2', value: '1.60' }
        ]
    }
]

const matches = props.matches && props.matches.length > 0 ? props.matches : defaultMatches

// Responsive logic
const isMobile = ref(false)

// Carousel logic
const currentIndex = ref(0)
let intervalId: any = null

function checkScreenSize() {
    isMobile.value = window.innerWidth < 768
}

function goTo(idx: number) {
    currentIndex.value = idx
    resetAutoPlay()
}

function next() {
    if (currentIndex.value < matches.length - 1) {
        currentIndex.value++
    } else {
        currentIndex.value = 0
    }
}

function prev() {
    if (currentIndex.value > 0) {
        currentIndex.value--
    } else {
        currentIndex.value = matches.length - 1
    }
}

function resetAutoPlay() {
    if (intervalId) {
        clearInterval(intervalId)
    }
    if (isMobile.value) {
        intervalId = setInterval(next, 3500)
    }
}

onMounted(() => {
    checkScreenSize()
    window.addEventListener('resize', checkScreenSize)
    
    if (isMobile.value) {
        intervalId = setInterval(next, 3500)
    }
})

onUnmounted(() => {
    window.removeEventListener('resize', checkScreenSize)
    if (intervalId) {
        clearInterval(intervalId)
    }
})
</script>