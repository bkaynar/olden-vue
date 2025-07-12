<template>
  <q-layout view="hHh Lpr l1f">
    <!-- Mobile Header -->
    <MobileHeader />
    
    <!-- Main content area -->
    <q-page-container class="main-content-wrapper">
      <q-page class="main-content">
        <slot />
      </q-page>
    </q-page-container>
    
    <!-- Mobile Footer -->
    <MobileFooter />
    
    <!-- Mobile Bottom Navigation -->
    <BottomNav />
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MobileHeader from '../components/MobileHeader.vue'
import MobileFooter from '../components/MobileFooter.vue'
import BottomNav from '../components/BottomNav.vue'

export default defineComponent({
  components: {
    MobileHeader,
    MobileFooter,
    BottomNav
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
