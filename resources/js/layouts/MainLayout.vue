<template>
  <q-layout view="lHh Lpr lFf" class="dark-layout">
    <AppHeader />
    <AppSidebar ref="sidebarRef" />

    <q-page-container class="dark-page-container">
      <q-page class="main-content">
        <slot />
      </q-page>
      <AppFooter />
    </q-page-container>

    <!-- Mobile Bottom Navigation -->
    <BottomNavigation @toggle-sidebar="toggleSidebar" />
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useQuasar } from 'quasar'
import AppHeader from '../components/Header.vue'
import AppSidebar from '../components/Sidebar.vue'
import BottomNavigation from '../components/BottomNavigation.vue'
import AppFooter from '../components/Footer.vue'

export default defineComponent({
  name: 'MainLayout',

  components: {
    AppHeader,
    AppSidebar,
    BottomNavigation,
    AppFooter,
  },

  setup() {
    const $q = useQuasar()
    const sidebarRef = ref<InstanceType<typeof AppSidebar> | null>(null)

    const toggleSidebar = () => {
      if (sidebarRef.value) {
        sidebarRef.value.toggleDrawer()
      }
    }

    return {
      $q,
      sidebarRef,
      toggleSidebar
    }
  }
})
</script>

<style>
/* Global Dark Theme */
body {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  color: white !important;
  margin: 0;
  padding: 0;
  min-height: 100vh;
}

#q-app {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  min-height: 100vh;
}

/* Layout Dark Classes */
.dark-layout {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  min-height: 100vh;
}

.dark-page-container {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  padding-top: 60px;
  padding-left: 280px;
  overflow-y: auto;
  height: 100vh;
}
</style>

<style scoped>
/* Global scroll sıfırlama */
:deep(html, body) {
  overflow: visible !important;
  height: auto !important;
}

.main-content {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%);
  min-height: calc(100vh - 60px);
  overflow-y: visible;
  display: flex;
  flex-direction: column;
  flex: 1;
  overflow-y: auto;
  position: relative;
}

.main-content::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%);
  z-index: -1;
}

/* Layout adjustments */
:deep(.q-layout) {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  min-height: 100vh;
}

:deep(.q-page-container) {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  padding-top: 60px;
  padding-left: 280px;
  overflow-y: auto;
  height: 100vh;
}

:deep(.q-page) {
  background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
}

/* Mobile adjustments */
@media (max-width: 767px) {
  :deep(.q-page-container) {
    padding-left: 0;
    padding-bottom: 80px;
    background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  }

  .main-content {
    min-height: calc(100vh - 60px - 80px);
    padding: 15px;
    background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%) !important;
  }
}

/* iPhone X ve sonrası için safe area desteği */
@supports (padding-bottom: env(safe-area-inset-bottom)) {
  @media (max-width: 767px) {
    :deep(.q-page-container) {
      padding-bottom: calc(80px + env(safe-area-inset-bottom));
    }
  }
}

/* Scrollbar Styling */
:deep(*::-webkit-scrollbar) {
  width: 6px;
}

:deep(*::-webkit-scrollbar-track) {
  background: rgba(255, 255, 255, 0.05);
}

:deep(*::-webkit-scrollbar-thumb) {
  background: rgba(0, 255, 136, 0.3);
  border-radius: 3px;
}

:deep(*::-webkit-scrollbar-thumb:hover) {
  background: rgba(0, 255, 136, 0.5);
}
</style>