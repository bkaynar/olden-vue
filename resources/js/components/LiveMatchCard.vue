<template>
    <div
        class="w-full max-w-[320px] min-w-[220px] h-[260px] md:h-[280px] bg-gradient-to-br from-[#1a232b] to-[#232a32] rounded-2xl shadow-lg text-white font-inter grid grid-rows-[auto_1fr_auto] overflow-hidden">
        <!-- Header -->
        <div class="h-10 bg-[#232a32] px-3 flex items-center">
            <img v-if="flag" :src="flag" alt="flag" class="w-4 h-3 object-cover rounded-sm mr-2 shadow-sm" />
            <span class="text-sm font-medium truncate">{{ league }}</span>
        </div>

        <!-- Main Content -->
        <div class="flex px-3 py-4 justify-between items-start">
            <!-- Teams -->
            <div class="flex flex-col space-y-1 flex-[2]">
                <span class="text-sm font-semibold truncate">{{ homeTeam }}</span>
                <span class="text-sm font-semibold truncate">{{ awayTeam }}</span>
            </div>
            <!-- Scores -->
            <div class="flex flex-col items-end space-y-1 flex-[1] ml-2">
                <div class="flex items-center space-x-1">
                    <span class="text-base font-bold">{{ homeScore }}</span>
                    <span class="text-xs font-medium text-gray-400">{{ homeScoreHalf }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="text-base font-bold">{{ awayScore }}</span>
                    <span class="text-xs font-medium text-gray-400">{{ awayScoreHalf }}</span>
                </div>
            </div>
            <!-- Status -->
            <div class="flex flex-col items-end ml-2 min-w-[40px]">
                <span class="text-xs font-bold bg-red-600 px-1.5 py-0.5 rounded">LIVE</span>
                <span class="text-xs text-gray-400 font-medium">{{ period }}</span>
                <span class="text-xs text-gray-400 font-medium">{{ minute }}'</span>
            </div>
        </div>

        <!-- Odds -->
        <div class="px-3 py-4 bg-[#232a32] grid grid-cols-[repeat(auto-fit,minmax(70px,1fr))] gap-2">
            <template v-for="(odd, idx) in odds" :key="idx">
                <div
                    class="bg-gradient-to-br from-[#1e272f] to-[#262f38] rounded-lg shadow-md p-2 flex flex-col items-center transition-transform duration-200 hover:-translate-y-1 hover:shadow-xl cursor-pointer">
                    <span class="text-xs uppercase text-gray-400 font-medium mb-1">{{ odd.label }}</span>
                    <span :class="['text-lg font-bold', odd.highlight ? 'text-yellow-300' : 'text-white']">{{ odd.value
                        }}</span>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import { defineProps, PropType } from 'vue'

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
// props kullanılmıyor hatası Vue script setup için normaldir, güvenle yok sayılabilir.
</script>

<!-- Tailwind ile responsive tasarım, ekstra stil gerekmiyor. -->
