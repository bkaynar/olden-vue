<template>
  <div class="top-winners--lc7eS">
    <div class="section-title--WFPh_">
      <div class="logo--IXshK loader--ud87y"></div>En çok kazananlar
    </div>
    <div class="slider--PreHF">
      <Swiper v-bind="swiperOptions" class="winners-swiper">
        <SwiperSlide v-for="(winner, i) in props.winners" :key="i">
          <div class="top-winner--YSmnA">
            <div class="top-winner-content--mqHl8">
              <div class="lazy-game-img--sjk9r loaded-high--jYvGy loaded--h8_TN game-image--SKdIM">
                <img :src="winner.cover || winner.gameImage" width="100" height="100" loading="lazy" alt="game" />
              </div>
              <div class="info--ksx3L">
                <div class="player--ZKWP9">
                  <div class="player-avatar--vPXMd">
                    <img width="16" height="16" alt="avatar" src="/images/default-avatar.png" />
                  </div>
                  <div class="ellipsis--_PsgU player-name--T85qf">{{ maskUsername(winner.username) }}</div>
                </div>
                <div class="ellipsis--_PsgU game-name--seVg0">{{ winner.gameName }}</div>
                <div class="ellipsis--_PsgU provider-name--zH6SO">{{ winner.provider }}</div>
              </div>
            </div>
            <div class="money-block--vNOv4">
              <div class="ellipsis--_PsgU money--tNRrR">₺ {{ winner.amount.toLocaleString('tr-TR', {
                minimumFractionDigits: 2
              }) }}</div>
            </div>
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
    gameName: string;
    provider: string;
    amount: number;
    gameImage: string;
    cover: string;
  }>
}>()

const modules = [Autoplay]

const swiperOptions = {
  modules,
  slidesPerView: 4,
  spaceBetween: 50,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  speed: 800,
  slidesPerGroup: 1,
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 30,
      slidesPerGroup: 1,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 40,
      slidesPerGroup: 1,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 45,
      slidesPerGroup: 1,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 50,
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

console.log('TopWinners props.winners:', props.winners)
</script>

<style scoped>
.winners-swiper {
  padding-bottom: 0;
}

.top-winner--YSmnA {
  height: 100%;
  display: flex;
  flex-direction: column;
  margin-right: 20px;
}

.swiper-slide {
  width: auto;
  margin-right: 20px;
}

:deep(.swiper-slide) {
  margin-right: 20px !important;
}
</style>
