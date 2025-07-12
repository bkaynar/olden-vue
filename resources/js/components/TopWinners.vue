<template>
  <div class="top-winners--lc7eS">
    <div class="section-title--WFPh_">
      <div class="logo--IXshK loader--ud87y"></div>En çok kazananlar
    </div>
    <div class="slider--PreHF">
      <Swiper v-bind="swiperOptions" class="winners-swiper">
        <SwiperSlide v-for="(winner, i) in props.winners" :key="i">
          <div class="winner-card">
            <div class="winner-avatar">
              {{ winner.username.charAt(0).toUpperCase() }}
            </div>
            <div class="winner-name">{{ maskUsername(winner.username) }}</div>
            <div class="winner-amount">₺{{ formatAmount(winner.amount) }}</div>
          </div>
        </SwiperSlide>
      </Swiper>
    </div>
    <div class="shadow--ScpBQ"></div>
  </div>
</template>

<script setup lang="ts">
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay } from 'swiper/modules'
import 'swiper/css'

const props = defineProps<{
  winners: Array<{
    username: string;
    amount: number;
  }>
}>()

const modules = [Autoplay]

const swiperOptions = {
  modules,
  slidesPerView: 6,
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  speed: 800,
  slidesPerGroup: 1,
  breakpoints: {
    320: {
      slidesPerView: 2,
      spaceBetween: 15,
      slidesPerGroup: 1,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 15,
      slidesPerGroup: 1,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 20,
      slidesPerGroup: 1,
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 20,
      slidesPerGroup: 1,
    },
  }
}

function maskUsername(username: string) {
  if (!username || username.length <= 4) return username;
  const first2 = username.slice(0, 2);
  const last2 = username.slice(-2);
  const stars = '*'.repeat(username.length - 4);
  return first2 + stars + last2;
}

function formatAmount(amount: number) {
  if (amount >= 1000000) {
    return (amount / 1000000).toFixed(1) + 'M';
  } else if (amount >= 1000) {
    return (amount / 1000).toFixed(1) + 'K';
  }
  return amount.toLocaleString('tr-TR');
}

console.log('TopWinners props.winners:', props.winners)
</script>

<style scoped>
.winners-swiper {
  padding-bottom: 0;
}

.winner-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, rgba(0, 255, 136, 0.1), rgba(0, 255, 136, 0.05));
  border: 1px solid rgba(0, 255, 136, 0.2);
  border-radius: 12px;
  padding: 12px 8px;
  text-align: center;
  backdrop-filter: blur(10px);
  min-height: 80px;
}

.winner-avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: linear-gradient(135deg, #00ff88, #00cc6a);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 700;
  color: #000;
  text-transform: uppercase;
}

.winner-name {
  font-size: 10px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.8);
  letter-spacing: 0.5px;
}

.winner-amount {
  font-size: 12px;
  font-weight: 700;
  color: #00ff88;
  text-shadow: 0 0 10px rgba(0, 255, 136, 0.3);
}

.swiper-slide {
  width: auto;
  margin-right: 20px;
}

:deep(.swiper-slide) {
  margin-right: 20px !important;
}
</style>
