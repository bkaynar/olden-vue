<template>
    <div class="all-games-for-landing--byfR9">
        <div class="section-title--WFPh_">
            <div class="logo--IXshK loader--ud87y"></div>Olden Oyunları
        </div>
        <div>
            <!-- bu alana game_type getireceğim-->
            <div class="flex--FROoX justify-content-space-between--FG9LF align-items-center--tfa4H width-full--aKfzU scroll-container--NegAT"
                style="gap: 20px;">
                <div class="scroll--actJt label-scroll--WHCwf">
                    <div class="scroll-inner--hoEfS"
                        style="user-select: none; -webkit-user-drag: none; touch-action: auto;">
                        <div class="track-wrapper--PYNfr">
                            <div class="track--VvsrB track--lLD_k">
                                <button v-for="gameType in gameTypes" 
                                        :key="gameType.key"
                                        @click="setCategory(gameType.key)"
                                        :class="['label--vzvXT', { 'active-label--fYpJ3': selectedCategory === gameType.key }]">
                                    <div class="ellipsis--_PsgU">{{ gameType.label }}</div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div><a href="/tr-tr/games/label/019034fe-d789-7e98-9743-58261ed28926"><button
                        class="button--okN8k grey--DEKty capitalize--NrNxB button-more--JCXpN">
                        <div class="content--PDGbx">
                            <div class="ellipsis--_PsgU">Tümünü Gör</div>
                        </div>
                    </button></a>
            </div>
            <!-- Games grid with dynamic data -->
            <div style="display: grid; grid-template: 1fr / repeat(6, 1fr); gap: 16px;">
                <div v-for="(game, index) in filteredGames.slice(0, 6)" :key="game.game_id" 
                     class="grid-item--hCbSj grid-item--i_Lyu" 
                     :style="`grid-area: 1 / ${index + 1} / span 1 / span 1;`">
                    <div class="grid-header--QFnkm" style="padding-bottom: calc(100% + 0px);">
                        <div class="grid-header-container--rxYb4">
                            <div class="inner--u4tpo">
                                <div class="lazy-game-img--sjk9r loaded-high--jYvGy loaded--h8_TN fallback--Bvtqc">
                                    <picture class="img-high--AQcT9 picture--Umaem game-img--EXXY2">
                                        <img class="img-high--AQcT9 picture--Umaem game-img--EXXY2" 
                                             width="300" 
                                             loading="lazy" 
                                             :alt="game.game_name" 
                                             :src="game.cover">
                                    </picture>
                                </div>
                                <div class="flex--FROoX badges--R9RLh badge--ugkBh" style="gap: 4px;">
                                    <div class="flex--FROoX align-items-center--tfa4H"
                                        style="display: inline-flex; align-items: center; gap: 2px; width: fit-content; max-width: 100%; padding: 2px 4px 2px 2px; border-radius: 4px; background: linear-gradient(90deg, rgb(208, 31, 201) 0%, rgb(71, 73, 246) 100%); color: rgb(254, 254, 254); font-variant-numeric: lining-nums tabular-nums; font-family: Gilroy; font-size: 10px; font-style: normal; font-weight: 600; line-height: 12px; text-transform: uppercase;">
                                        <picture class="icon--QgkaG">
                                            <source srcset="
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.webp?format=webp&amp;height=12&amp;width=12 1x,
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.webp?format=webp&amp;height=24&amp;width=24 2x
  ">
                                            <source srcset="
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.jpg?height=12&amp;width=12 1x,
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.jpg?height=24&amp;width=24 2x
  "><img class="icon--QgkaG" width="12" height="12" loading="lazy" alt="picture" srcset="
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.jpg?height=12&amp;width=12 1x,
  https://api-baywin-tr--prd--pl-sb.dt3dterd.com/fileserver_public__api/public/gamemanager/b0ffe58e70454defa0efaf993dfd1ddb__QWRzJUM0JUIxeit0YXNhciVDNCVCMW0ucG5n.jpg?height=24&amp;width=24 2x
  ">
                                        </picture>
                                        <div class="ellipsis--_PsgU">{{ game.provider_name }}
                                        </div>
                                    </div>
                                    <div v-if="game.eniyi" class="flex--FROoX align-items-center--tfa4H"
                                        style="display: inline-flex; align-items: center; gap: 2px; width: fit-content; max-width: 100%; padding: 2px 4px 2px 2px; border-radius: 4px; background: linear-gradient(rgb(86, 233, 13) 0%, rgb(13, 136, 21) 100%); color: rgb(254, 254, 254); font-variant-numeric: lining-nums tabular-nums; font-family: Gilroy; font-size: 10px; font-style: normal; font-weight: 600; line-height: 12px; text-transform: uppercase;">
                                        <div class="ellipsis--_PsgU">En İyi</div>
                                    </div>
                                    <div v-if="game.populer" class="flex--FROoX align-items-center--tfa4H"
                                        style="display: inline-flex; align-items: center; gap: 2px; padding: 2px 4px; width: fit-content; max-width: 100%; font-size: 10px; line-height: 15px; font-weight: 600; font-variant-numeric: lining-nums tabular-nums; border-radius: 4px; background: rgb(255, 0, 4); color: rgb(254, 254, 254); text-transform: uppercase; font-family: Gilroy;">
                                        <div class="ellipsis--_PsgU">Popüler
                                        </div>
                                    </div>
                                </div>
                                <div class="game-overlay--zlXt0"><a class="link--EXVkB"
                                        :href="`/tr-tr/play_demo_game/${game.game_id}`">
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
                        <div class="ellipsis--_PsgU game-name--QVKni">{{ game.game_name }}
                        </div>
                        <div class="ellipsis--_PsgU provider-name--D0UL6">{{ game.provider_name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue'

export default defineComponent({
    name: 'LigoGames',
    props: {
        allGames: {
            type: Array,
            default: () => []
        }
    },
    setup(props) {
        const selectedCategory = ref('all')

        const gameTypes = computed(() => {
            const types = [...new Set(props.allGames.map((game: any) => game.category).filter(Boolean))]
            return [{ key: 'all', label: 'Tümü' }, ...types.map(type => ({ key: type, label: type }))]
        })

        const filteredGames = computed(() => {
            if (selectedCategory.value === 'all') {
                return props.allGames
            }
            return props.allGames.filter((game: any) => game.category === selectedCategory.value)
        })

        const setCategory = (category: string) => {
            selectedCategory.value = category
        }

        return {
            selectedCategory,
            gameTypes,
            filteredGames,
            setCategory
        }
    }
});
</script>
