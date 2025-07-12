<template>
    <div class="main-page--iqket">
        <div class="page--rJpFf">
            <div class="main--mG7G7">
                <HomeCarousel />
                <div class="landing-page--Unyg2">
                    <!-- Top Winners -->
                    <TopWinners :tabs="winnerTabs" :active-tab="activeTab" :winners="filteredWinners"
                        @tab-change="activeTab = $event" />
                    <DavetEtKazan />
                    <LigoGames />
                    <LigoCasino />
                    <LigoLiveCasino />
                    <OldenHomeBanner/>
                    <!--<OldenPreFooter />-->
                </div>
            </div>
            <AppFooter />
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useHead } from '@vueuse/head'
import MainLayout from '../layouts/MainLayout.vue'
import TopWinners from '@/components/TopWinners.vue';
import DavetEtKazan from '@/components/DavetEtKazan.vue';
import LigoGames from '@/components/LigoGames.vue'
import LigoCasino from '@/components/LigoCasino.vue';
import AppFooter from '@/components/Footer.vue';
import HomeCarousel from '@/components/HomeCarousel.vue';
import LigoLiveCasino from '@/components/LigoLiveCasino.vue';
import OldenHomeBanner from '@/components/OldenHomeBanner.vue';
// Make sure the file exists at the specified path, or update the path if necessary
import OldenPreFooter from '@/components/OldenPreFooter.vue';

export default defineComponent({
    name: 'HomePage',
    layout: MainLayout,
    components: { TopWinners, DavetEtKazan, LigoGames, LigoCasino, AppFooter, HomeCarousel, LigoLiveCasino, OldenHomeBanner, OldenPreFooter },
    props: {
        carouselItems: {
            type: Array,
            required: true
        },
        lastWinners: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const page = usePage()
        useHead({
            title: page.props.siteTitle as string,
            meta: [
                { name: 'description', content: page.props.siteTitle as string },
                { name: 'keywords', content: page.props.siteKeywords as string },
            ],
            link: [
                { rel: 'icon', href: page.props.favicon as string }
            ]
        })

        const activeTab = ref('casino')
        const winnerTabs = ref([
            { key: 'casino', label: 'Casino' },
            { key: 'originals', label: 'Baywin Originals' },
            { key: 'live', label: 'Canlı Casino' },
            { key: 'games', label: 'Oyunlar' },
            { key: 'sports', label: 'Sports' }
        ])

        // winners kaldırıldı, doğrudan props.lastWinners kullanılıyor
        const filteredWinners = computed(() => {
            return props.lastWinners
        })

        const joinNow = () => {
            console.log('Join now clicked')
        }

        return {
            ...props,
            activeTab,
            winnerTabs,
            filteredWinners,
            joinNow
        }
    }
})
</script>