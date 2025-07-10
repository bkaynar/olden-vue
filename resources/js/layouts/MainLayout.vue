<template>
  <q-layout view="lHh Lpr lFf">
    <AppHeader />
    <AppSidebar />
    
    <q-page-container>
      <q-page class="main-content">
        <slot />
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppHeader from '../components/Header.vue'
import AppSidebar from '../components/Sidebar.vue'

export default defineComponent({
  name: 'MainLayout',
  
  components: {
    AppHeader,
    AppSidebar
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

@media (max-width: 1023px) {
  :deep(.q-page-container) {
    padding-left: 0;
  }
}
</style>