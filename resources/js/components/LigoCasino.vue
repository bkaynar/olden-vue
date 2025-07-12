<template>
    <div class="all-games-for-landing--byfR9">
        <div class="section-title--WFPh_">
            <div class="logo--IXshK loader--ud87y"></div>Olden Yeni Oyunlar
        </div>
        <div>
            <div class="flex--FROoX justify-content-space-between--FG9LF align-items-center--tfa4H width-full--aKfzU scroll-container--NegAT"
                style="gap: 20px;">
                <div class="scroll--actJt label-scroll--WHCwf">
                    <div class="scroll-inner--hoEfS"
                        style="user-select: none; -webkit-user-drag: none; touch-action: auto;">
                        <div class="track-wrapper--PYNfr">
                            <div class="track--VvsrB track--lLD_k">
                                <button v-for="category in gameCategories" 
                                        :key="category.key"
                                        @click="setCategory(category.key)"
                                        :class="['label--vzvXT', { 'active-label--fYpJ3': selectedCategory === category.key }]">
                                    <div class="ellipsis--_PsgU">{{ category.label }}</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div><a href="/tr-tr/casino/label/c4c9e582-7068-4233-bbdc-37ec9fca0926"><button
                        class="button--okN8k grey--DEKty capitalize--NrNxB button-more--JCXpN">
                        <div class="content--PDGbx">
                            <div class="ellipsis--_PsgU">Tümünü Gör</div>
                        </div>
                    </button></a>
            </div>
            <div style="display: grid; grid-template: 1fr / repeat(6, 1fr); gap: 16px;">
                <div v-for="(oyun, index) in filteredGames.slice(0, 6)" :key="index" 
                     class="grid-item--hCbSj grid-item--i_Lyu" 
                     :style="`grid-area: 1 / ${index + 1} / span 1 / span 1;`">
                    <div class="grid-header--QFnkm" style="padding-bottom: calc(100% + 0px);">
                        <div class="grid-header-container--rxYb4">
                            <div class="inner--u4tpo">
                                <div class="lazy-game-img--sjk9r loaded-high--jYvGy loaded--h8_TN fallback--Bvtqc">
                                    <picture class="img-high--AQcT9 picture--Umaem game-img--EXXY2">
                                        <img class="img-high--AQcT9 picture--Umaem game-img--EXXY2" 
                                             loading="lazy"
                                             :alt="`Oyun ${index + 1}`"
                                             :src="oyun.gorsel">
                                    </picture>
                                </div>
                                <div class="flex--FROoX badges--R9RLh badge--ugkBh" style="gap: 4px;">
                                    <div class="flex--FROoX align-items-center--tfa4H"
                                        style="display: inline-flex; align-items: center; gap: 2px; padding: 2px 4px; width: fit-content; max-width: 100%; font-size: 10px; line-height: 12px; font-weight: 600; font-variant-numeric: lining-nums tabular-nums; border-radius: 4px; background: rgb(0, 255, 136); color: rgb(0, 0, 0); text-transform: uppercase; font-family: Gilroy;">
                                        <div class="ellipsis--_PsgU">Yeni</div>
                                    </div>
                                </div>
                                <div class="flex--FROoX align-items-center--tfa4H online--PCqtz online--yEzQx"
                                    style="gap: 8px;"><span class="wrapper--xQUxI brand-color--Cy1CA"
                                        style="height: 18px; width: 18px; min-width: 18px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20" fill="none">
                                            <path
                                                d="M8.5 6C8.5 7.38071 7.38071 8.5 6 8.5C4.61929 8.5 3.5 7.38071 3.5 6C3.5 4.61929 4.61929 3.5 6 3.5C7.38071 3.5 8.5 4.61929 8.5 6ZM16.5 6C16.5 7.38071 15.3807 8.5 14 8.5C12.6193 8.5 11.5 7.38071 11.5 6C11.5 4.61929 12.6193 3.5 14 3.5C15.3807 3.5 16.5 4.61929 16.5 6ZM18.5 16.5H13.4836C13.4945 16.3347 13.5 16.168 13.5 16C13.5 14.4672 13.0397 13.0408 12.25 11.8528C12.7876 11.6257 13.3787 11.5 14 11.5C16.4853 11.5 18.5 13.5147 18.5 16V16.5ZM6 11.5C8.48528 11.5 10.5 13.5147 10.5 16V16.5H1.5V16C1.5 13.5147 3.51472 11.5 6 11.5Z"
                                                stroke="currentColor"></path>
                                        </svg></span>
                                    <div class="flex--FROoX align-items-center--tfa4H" style="gap: 4px;"><span
                                            class="online-count--doIgZ">10</span>
                                        <div class="ellipsis--_PsgU">oyuncu</div>
                                    </div>
                                </div>
                                <div class="game-overlay--zlXt0"><a class="link--EXVkB"
                                        :href="oyun.url">
                                        <div class="flex--FROoX direction-column--e4TCZ justify-content-space-between--FG9LF align-items-flex-end--GQYyT width-full--aKfzU overlay--_OWzB"
                                            style="gap: 2px;">
                                            <div class="fav--vC9GF visible--yXKHs">
                                                <button class="fav-button--VvELC"><span
                                                        class="wrapper--xQUxI text-color--E3Qng"
                                                        style="height: 24px; width: 24px; min-width: 24px;"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <g clip-path="url(#clip0_719_833)">
                                                                <path
                                                                    d="M11.0919 1.96866C11.4494 1.19379 12.5506 1.19379 12.9081 1.96866L15.1512 6.83177C15.2969 7.14758 15.5961 7.36502 15.9415 7.40597L21.2598 8.03653C22.1072 8.137 22.4475 9.18439 21.821 9.76376L17.889 13.3999C17.6337 13.636 17.5194 13.9878 17.5872 14.329L18.6309 19.5818C18.7972 20.4187 17.9062 21.0661 17.1616 20.6493L12.4884 18.0334C12.185 17.8635 11.815 17.8635 11.5116 18.0334L6.83836 20.6493C6.09375 21.0661 5.20279 20.4187 5.3691 19.5818L6.41282 14.329C6.4806 13.9878 6.36629 13.636 6.11095 13.3999L2.17903 9.76376C1.55253 9.18439 1.89284 8.13701 2.74024 8.03653L8.05849 7.40597C8.40386 7.36502 8.70314 7.14758 8.84881 6.83177L11.0919 1.96866Z"
                                                                    stroke="currentColor" stroke-width="2">
                                                                </path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_719_833">
                                                                    <rect width="24" height="24" fill="white">
                                                                    </rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg></span></button>
                                            </div>
                                            <button class="button--okN8k green--XmZ8b button-demo-play--MgMZg">
                                                <div class="content--PDGbx">
                                                    <div class="ellipsis--_PsgU">
                                                        Oyna</div>
                                                </div>
                                            </button>
                                        </div>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="game-bottom-info--FddEW" style="height: 56px;">
                        <div class="ellipsis--_PsgU game-name--QVKni">Oyun {{ index + 1 }}</div>
                        <div class="ellipsis--_PsgU provider-name--D0UL6">Olden Casino</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue'

export default defineComponent({
    name: 'LigoCasino',
    props: {
        oyunlar: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const selectedCategory = ref('all')

        const gameCategories = computed(() => {
            return [{ key: 'all', label: 'Tümü' }]
        })

        const filteredGames = computed(() => {
            return props.oyunlar
        })

        const setCategory = (category: string) => {
            selectedCategory.value = category
        }

        return {
            selectedCategory,
            gameCategories,
            filteredGames,
            setCategory
        }
    }
});
</script>
