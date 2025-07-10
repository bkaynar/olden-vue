<template>
  <q-layout view="lHh Lpr lFf">
    <AppHeader />
    <AppSidebar ref="sidebarRef" />

    <q-page-container>
      <q-page class="main-content">
        <slot />
      </q-page>
    </q-page-container>

    <!-- Mobile Bottom Navigation -->
    <BottomNavigation @toggle-sidebar="toggleSidebar" />
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import AppHeader from '../components/Header.vue'
import AppSidebar from '../components/Sidebar.vue'
import BottomNavigation from '../components/BottomNavigation.vue'

export default defineComponent({
  name: 'MainLayout',

  components: {
    AppHeader,
    AppSidebar,
    BottomNavigation
  },

  setup() {
    const sidebarRef = ref<InstanceType<typeof AppSidebar> | null>(null)

    const toggleSidebar = () => {
      if (sidebarRef.value) {
        sidebarRef.value.toggleDrawer()
      }
    }

    return {
      sidebarRef,
      toggleSidebar
    }
  }
})
</script>

<style scoped>
.main-content {
  background: #1a1a1a;
  min-height: calc(100vh - 60px);
  padding: 0;
}

/* Layout adjustments */
:deep(.q-layout) {
  background: #1a1a1a;
}

:deep(.q-page-container) {
  padding-top: 60px;
  padding-left: 280px;
}

/* Mobile adjustments */
@media (max-width: 1023px) {
  :deep(.q-page-container) {
    padding-left: 0;
    padding-bottom: 80px;
    /* Bottom navigation için alan */
  }

  .main-content {
    min-height: calc(100vh - 60px - 80px);
    /* Header ve bottom nav için */
  }
}

/* iPhone X ve sonrası için safe area desteği */
@supports (padding-bottom: env(safe-area-inset-bottom)) {
  @media (max-width: 1023px) {
    :deep(.q-page-container) {
      padding-bottom: calc(80px + env(safe-area-inset-bottom));
    }
  }
}
</style>