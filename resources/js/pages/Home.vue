<template>
    <div class="home-page">

        <!-- Hero Carousel -->
        <HeroCarousel :carousel-items="carouselItems" @join-now="joinNow" />
        <div class="section-header">
            <div class="section-title">
                <q-icon name="people" color="green" size="md" />
                <span>Son Kazananlar</span>
            </div>
        </div>

        <TopWinners :last-winners="lastWinners" />

        <div class="ligobet-games-section">
            <div class="section-header">
                <div class="section-title">
                    <q-icon name="sports_soccer" color="yellow" size="md" />
                    <span>Canlı Maçlar</span>
                </div>
            </div>
            <LiveMatchesRow />
        </div>

        <!-- Ligobet Oyunlar Section -->
        <div class="ligobet-games-section">
            <div class="section-header">
                <div class="section-title">
                    <q-icon name="casino" color="green" size="md" />
                    <span>Ligobet Oyunlar</span>
                </div>
            </div>
            <Games :games="games" />
        </div>

        <!-- Canlı Casino Section -->
        <div class="ligobet-games-section">
            <div class="section-header">
                <div class="section-title">
                    <q-icon name="casino" color="red" size="md" />
                    <span>Canlı Casino</span>
                </div>
                <q-btn flat rounded dense class="view-all-btn" label="Tümünü Gör" icon-right="arrow_forward" />
            </div>
            <LiveCasino :games="liveCasinoGames" />
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import MainLayout from '../layouts/MainLayout.vue'
import HeroCarousel from '../components/HeroCarousel.vue'
import TopWinners from '../components/TopWinners.vue'
import Games from '../components/Games.vue'
import LiveCasino from '../components/LiveCasino.vue'
import LiveMatchesRow from '../components/LiveMatchesRow.vue'

export default defineComponent({
    name: 'HomePage',
    layout: MainLayout,
    components: { HeroCarousel, TopWinners, Games, LiveCasino, LiveMatchesRow },
    props: {
        carouselItems: {
            type: Array,
            required: true
        },
        lastWinners: {
            type: Array,
            required: true
        },
        allGames: {
            type: Array,
            required: false,
            default: () => []
        },
        liveCasinoGames: {
            type: Array,
            required: false,
            default: () => []
        }
    },
    setup(props) {
        console.log('allGames backendden:', props.allGames)
        const activeTab = ref('casino')
        const winnerTabs = ref([
            { key: 'casino', label: 'Casino' },
            { key: 'originals', label: 'Baywin Originals' },
            { key: 'live', label: 'Canlı Casino' },
            { key: 'games', label: 'Oyunlar' },
            { key: 'sports', label: 'Sports' }
        ])
        const games = ref((props.allGames ?? []) as any)
        const liveCasinoGames = ref((props.liveCasinoGames ?? []) as any)
        const inviteRewards = ref([
            { id: 1, username: 'or***07', amount: '250.00' },
            { id: 2, username: 'bi***ka', amount: '250.00' },
            { id: 3, username: 'Sa***as', amount: '250.00' },
            { id: 4, username: 'Cr***a', amount: '250.00' },
            { id: 5, username: 'Ba***i', amount: '275.00' },
            { id: 6, username: 'Al***42', amount: '250.00' },
            { id: 7, username: 'Az***90', amount: '250.00' }
        ])
        const joinNow = () => {
            console.log('Join now clicked')
        }
        const playGame = () => { }
        return {
            ...props,
            activeTab,
            winnerTabs,
            games,
            liveCasinoGames,
            inviteRewards,
            joinNow,
            playGame
        }
    }
})
</script>

<style scoped>
.home-page {
    background: #14171f url('/images/bg.png') no-repeat center center;
    background-size: cover;
    background-attachment: fixed;

    min-height: 100vh;
    padding: 20px;
}



.slide-image img {
    width: 400px;
    height: 250px;
    object-fit: cover;
    border-radius: 12px;
}
.ligobet-games-section {
    margin-bottom: 40px;
    padding-top: 16px
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
    font-weight: bold;
    color: white;
}

.game-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.game-card:hover .game-overlay {
    opacity: 1;
}


/* Responsive */
@media (max-width: 768px) {

    .section-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .section-title {
        font-size: 18px;
        gap: 8px;
    }

    .section-title span {
        font-size: 16px;
    }

    .view-all-btn {
        min-width: 100px;
        font-size: 12px;
        height: 32px;
        padding: 4px 8px !important;
    }

    .view-all-btn .q-btn__content {
        gap: 4px;
    }
}

.view-all-btn {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
    transition: all 0.3s ease;
    min-width: 160px;
    right: 20px;
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
</style>
