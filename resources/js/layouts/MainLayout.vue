<template>
  <q-layout view="hHh Lpr lFf">
    <!-- Header tam genişlik -->
    <AppHeader />

    <!-- Main wrapper - header altındaki tüm içerik için -->
    <div class="main-wrapper">
      <!-- Sidebar solda sabit -->
      <AppSidebar />

      <!-- Sağdaki içerik alanı -->
      <q-page-container class="main-content-wrapper">
        <q-page class="main-content">
          <slot />
          <AppFooter />
        </q-page>
      </q-page-container>
    </div>

    <!-- Mobile Bottom Navigation -->
    <BottomNavigation />
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import AppHeader from '../components/Header.vue'
import AppSidebar from '../components/Sidebar.vue'

export default defineComponent({
  components: {
    AppHeader,
    AppSidebar,
  }
})
</script>

<style scoped>
.q-layout,
.main-wrapper,
.main-content-wrapper {
  background-color: var(--background, #000000);
}
</style>
