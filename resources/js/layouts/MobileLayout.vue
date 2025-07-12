<template>
  <q-layout view="hHh Lpr l1f">
    <slot/>
  </q-layout>
</template>
s
<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    
  }
})
</script>

<style scoped>
.q-layout,
.main-wrapper,
.main-content-wrapper {
  background-color: var(--background, #000000);
  overflow-x: hidden;
  max-width: 100vw;
  width: 100%;
  box-sizing: border-box;
}

/* Ensure mobile layout prevents horizontal overflow */
.q-layout {
  position: relative;
}

/* Prevent body from scrolling horizontally */
:global(body) {
  overflow-x: hidden;
  max-width: 100vw;
}

/* Ensure all child elements respect mobile constraints */
* {
  box-sizing: border-box;
}
</style>
