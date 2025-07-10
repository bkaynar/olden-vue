<template>
    <div class="hero-section">
        <q-carousel v-model="slide" animated arrows infinite :autoplay="5000" class="hero-carousel">
            <q-carousel-slide v-for="(item, index) in carouselItems" :key="index" :name="index" class="carousel-slide">
                <div class="slide-content">
                    <img 
                        :src="item.gorsel || 'https://via.placeholder.com/800x400?text=Slider'" 
                        alt="Slider" 
                        class="slide-image"
                    />
                </div>
            </q-carousel-slide>
        </q-carousel>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, PropType, watch } from 'vue'

export default defineComponent({
    name: 'HeroCarousel',
    props: {
        carouselItems: {
            type: Array as PropType<Array<any>>,
            required: true
        }
    },
    emits: ['join-now'],
    setup(props, { emit }) {
        const slide = ref(0)
        // Debug amaçlı veri konsola yazdır
        watch(() => props.carouselItems, (val) => {
            console.log('CarouselItems:', val)
        }, { immediate: true })
        return { slide, emit }
    }
})
</script>

<style scoped>
.hero-section {
    margin-bottom: 40px;
}

.hero-carousel {
    height: 400px;
    border-radius: 16px;
    overflow: hidden;
}

.carousel-slide {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.slide-content {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.slide-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
}

@media (max-width: 768px) {
    .hero-carousel {
        height: 250px;
    }
}

@media (max-width: 480px) {
    .hero-carousel {
        height: 200px;
    }
}
</style>