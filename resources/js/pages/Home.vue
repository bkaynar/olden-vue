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
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import MainLayout from '../layouts/MainLayout.vue'
import HeroCarousel from '../components/HeroCarousel.vue'
import TopWinners from '../components/TopWinners.vue'
import Games from '../components/Games.vue'

export default defineComponent({
    name: 'HomePage',
    layout: MainLayout,
    components: { HeroCarousel, TopWinners, Games },
    props: {
        carouselItems: {
            type: Array,
            required: true
        },
        lastWinners: {
            type: Array,
            required: true
        }
    },
    setup(props) {
        const activeTab = ref('casino')
        const winnerTabs = ref([
            { key: 'casino', label: 'Casino' },
            { key: 'originals', label: 'Baywin Originals' },
            { key: 'live', label: 'Canlı Casino' },
            { key: 'games', label: 'Oyunlar' },
            { key: 'sports', label: 'Sports' }
        ])
        const games = ref([])
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
            ...props, // include carouselItems and lastWinners
            activeTab,
            winnerTabs,
            games,
            inviteRewards,
            joinNow,
            playGame
        }
    }
})
</script>

<style scoped>
.home-page {
    background: #14171f;
    min-height: 100vh;
    padding: 20px;
}

/* Hero Carousel */
.hero-section {
    margin-bottom: 40px;
}

.hero-carousel {
    height: 300px;
    border-radius: 16px;
    overflow: hidden;
}

.carousel-slide {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 60px;
}

.slide-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 100%;
    position: relative;
}

.slide-text {
    flex: 1;
    z-index: 2;
}

.slide-title {
    font-size: 32px;
    font-weight: bold;
    color: white;
    margin: 0 0 16px 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.slide-amount {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-bottom: 8px;
}

.amount-number {
    font-size: 72px;
    font-weight: bold;
    color: white;
    line-height: 1;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.amount-currency {
    font-size: 32px;
    color: #00ff88;
    font-weight: bold;
}

.slide-subtitle {
    font-size: 20px;
    color: white;
    font-weight: 600;
    margin-bottom: 24px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.slide-button {
    background: #ffed4e;
    color: #1a1a1a;
    font-weight: bold;
    padding: 12px 32px;
    border-radius: 25px;
    font-size: 16px;
}

.slide-image {
    position: absolute;
    right: 60px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
}

.slide-image img {
    width: 400px;
    height: 250px;
    object-fit: cover;
    border-radius: 12px;
}

.slide-details {
    position: absolute;
    bottom: 20px;
    left: 60px;
    display: flex;
    align-items: center;
    gap: 16px;
    z-index: 2;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-size: 12px;
    color: #00ff88;
    font-weight: 600;
}

.detail-value {
    font-size: 14px;
    color: white;
    font-weight: 500;
}

.detail-divider {
    color: #666;
    font-size: 14px;
}

/* Section Styles */
.winners-section,
.invite-section,
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

.section-tabs {
    display: flex;
    gap: 8px;
}

.tab-btn {
    color: #999;
    background: transparent;
    border-radius: 20px;
    padding: 8px 16px;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background: #00ff88;
    color: #1a1a1a;
}

.tab-btn:hover {
    background: rgba(0, 255, 136, 0.1);
    color: #00ff88;
}

/* Games Grid */
.winners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.game-card {
    background: #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}

.game-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 255, 136, 0.3);
}

.game-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.game-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.game-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.game-card:hover .game-overlay {
    opacity: 1;
}

.game-info {
    padding: 16px;
}

.game-provider {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #999;
    font-size: 12px;
    margin-bottom: 8px;
}

.game-name {
    color: white;
    font-size: 16px;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.game-amount {
    color: #00ff88;
    font-size: 18px;
    font-weight: bold;
}

/* Invite Section */
.invite-rewards {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    padding: 16px 0;
}

.reward-item {
    background: #2a2a2a;
    border-radius: 12px;
    padding: 16px;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.reward-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 600;
}

.reward-status.live {
    color: #ff4757;
}

.reward-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.reward-user {
    display: flex;
    align-items: center;
    gap: 8px;
}

.username {
    color: #ccc;
    font-size: 14px;
}

.reward-amount {
    color: #00ff88;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 768px) {
    .slide-content {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .slide-image {
        position: static;
        transform: none;
        margin-top: 20px;
    }

    .slide-details {
        position: static;
        justify-content: center;
        margin-top: 20px;
    }

    .winners-grid {
        grid-template-columns: 1fr;
    }

    .section-header {
        flex-direction: column;
        gap: 16px;
    }
}
</style>