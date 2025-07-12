<template>
    <div class="banner-container--ermJA banner-variant--jnwci">
        <div class="desktop--V0CrN">
            <div class="carousel-container--W3CqL">
                <div style="position: relative;">
                    <Swiper
                        ref="swiperRef"
                        v-bind="swiperOptions"
                        class="carousel--sPpxd"
                    >
                        <SwiperSlide 
                            v-for="(item, index) in carouselItems" 
                            :key="index"
                        >
                            <div class="banner--cswSm">
                                <picture class="image--E8HoT">
                                    <img 
                                        class="image--E8HoT" 
                                        :alt="`Banner ${index + 1}`"
                                        :src="item.gorsel"
                                        style="object-fit:fill;"
                                    >
                                </picture>
                                <a 
                                    v-if="item.url" 
                                    :href="item.url"
                                    target="_blank" 
                                    class="link--XjtPY"
                                ></a>
                                <div class="info--OxnMp">
                                    <div class="title1--Y9km0"></div>
                                    <div class="title2--sjnLy"></div>
                                    <div class="title3--np78e"></div>
                                    <div class="description--Dq0fb"></div>
                                </div>
                            </div>
                        </SwiperSlide>
                    </Swiper>
                    
                    <!-- Pagination Dots -->
                    <div class="pagination-container">
                        <div class="carousel-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent, ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Pagination } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

export default defineComponent({
    name: 'HomeCarousel',
    components: {
        Swiper,
        SwiperSlide
    },
    props: {
        carouselItems: {
            type: Array,
            default: () => []
        }
    },
    setup() {
        const swiperRef = ref(null)
        const currentSlide = ref(0)

        const modules = [Autoplay, Pagination]

        const swiperOptions = {
            modules,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.carousel-pagination',
                clickable: true,
                enabled: true,
                bulletClass: 'dot--kZnIh',
                bulletActiveClass: 'active--ahLJx',
                renderBullet: (index: number, className: string) => {
                    return `<div class="${className}" data-slide="${index}"></div>`
                }
            },
            on: {
                slideChange: (swiper: any) => {
                    currentSlide.value = swiper.realIndex
                }
            }
        }

        const goToSlide = (index: number) => {
            if (swiperRef.value) {
                (swiperRef.value as any).slideTo(index)
            }
        }

        return {
            swiperRef,
            currentSlide,
            swiperOptions,
            goToSlide
        }
    }
});
</script>

<style scoped>
/* Pagination Container */
.pagination-container {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
}


.carousel-pagination {
    display: flex;
    gap: 8px;
    align-items: center;
}

:deep(.carousel-pagination .dot--kZnIh) {
    width: 30px;
    height: 4px;
    border-radius: 2px;
    background: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: all 0.4s ease;
}

:deep(.carousel-pagination .dot--kZnIh.active--ahLJx) {
    background: #ffffff;
    width: 40px;
    height: 4px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
}
</style>
