<template>
  <div class="top-winners--lc7eS">
    <div class="section-title--WFPh_">
      <div class="logo--IXshK loader--ud87y"></div>En çok kazananlar
    </div>
    <div class="slider--PreHF">
      <div v-for="(winner, i) in props.winners" :key="i" class="top-winner--YSmnA">
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
            minimumFractionDigits:
              2
          }) }}</div>
        </div>
      </div>
    </div>
    <div class="shadow--ScpBQ"></div>
  </div>
</template>

<script setup lang="ts">
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

function maskUsername(username: string) {
  if (!username || username.length <= 4) return username;
  const first2 = username.slice(0, 2);
  const last2 = username.slice(-2);
  const stars = '*'.repeat(username.length - 4);
  return first2 + stars + last2;
}

console.log('TopWinners props.winners:', props.winners)
</script>
