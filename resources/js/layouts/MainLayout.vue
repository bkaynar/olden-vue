<template>
  <q-layout view="lHh Lpr lFf">
    <AppHeader />
    <AppSidebar ref="sidebarRef" />

    <q-page-container>
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

<style scoped>
/* Global scroll sıfırlama */
:deep(html, body) {
  overflow: visible !important;
  height: auto !important;
}

.main-content {
  background: url('images/bg.png') no-repeat center center;
  background-size: cover;
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
  background: url('/public/images/bg.png') no-repeat center center;
  background-size: cover;
  z-index: -1;
}

/* Layout adjustments */
:deep(.q-layout) {
  background: #1a1a1a;
  min-height: 100vh;
}

:deep(.q-page-container) {
  padding-top: 60px;
  padding-left: 280px;
  overflow-y: auto;
  height: 100vh;
  /* Bütünüyle viewport’u kapla */
}

/* Mobile adjustments */
@media (max-width: 767px) {
  :deep(.q-page-container) {
    padding-left: 0;
    padding-bottom: 80px;
    /* Bottom navigation için alan */
  }

  .main-content {
    min-height: calc(100vh - 60px - 80px);
    padding: 15px;
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
</style>
