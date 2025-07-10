<template>
  <q-drawer v-model="drawer" show-if-above :width="280" class="bg-dark" side="left" bordered>
    <div class="sidebar-content">
      <!-- Logo -->
      <div class="sidebar-logo">
        <img src="/images/logon.png" alt="Logo" class="sidebar-logo-img" />
      </div>

      <!-- Navigation Menu -->
      <q-list class="menu-list">
        <q-item v-for="item in menuItems" :key="item.name" :class="['menu-item', { active: item.active }]" clickable
          @click="selectMenuItem(item)">
          <q-item-section avatar>
            <q-icon :name="item.icon" :color="item.active ? 'green' : 'grey-5'" />
          </q-item-section>
          <q-item-section>
            <q-item-label :class="['menu-label', { active: item.active }]">
              {{ item.label }}
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>

      <!-- Bottom Support Section -->
      <div class="support-section">
        <div class="support-item">
          <q-icon name="headset_mic" color="grey-5" />
          <span class="support-text">Canlı Destek</span>
          <div class="support-flag">
            <q-icon name="language" color="red" />
          </div>
        </div>
      </div>
    </div>
  </q-drawer>
</template>

<script>
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'AppSidebar',

  setup() {
    const drawer = ref(true)

    const menuItems = ref([
      {
        name: 'home',
        label: 'Ana Sayfa',
        icon: 'home',
        active: true
      },
      {
        name: 'sports',
        label: 'Spor Bahisleri',
        icon: 'sports_soccer',
        active: false
      },
      {
        name: 'live',
        label: 'Canlı Bahis',
        icon: 'live_tv',
        active: false
      },
      {
        name: 'tournaments',
        label: 'Turnuvalar',
        icon: 'emoji_events',
        active: false
      },
      {
        name: 'casino',
        label: 'Casino',
        icon: 'casino',
        active: false
      },
      {
        name: 'virtual',
        label: 'Tapking',
        icon: 'sports_esports',
        active: false
      },
      {
        name: 'live-casino',
        label: 'Canlı Casino',
        icon: 'videocam',
        active: false
      },
      {
        name: 'originals',
        label: 'Baywin Originals',
        icon: 'stars',
        active: false
      },
      {
        name: 'games',
        label: 'Oyunlar',
        icon: 'games',
        active: false
      },
      {
        name: 'esports',
        label: 'E-Spor',
        icon: 'sports_esports',
        active: false
      },
      {
        name: 'virtual-sports',
        label: 'Sanal Bahis',
        icon: 'computer',
        active: false
      }
    ])

    const selectMenuItem = (item) => {
      menuItems.value.forEach(menuItem => {
        menuItem.active = menuItem.name === item.name
      })
    }

    return {
      drawer,
      menuItems,
      selectMenuItem
    }
  }
})
</script>

<style scoped>
.sidebar-content {
  height: 100%;
  display: flex;
  flex-direction: column;
  background: #20242e;
  border-right: 1px solid #333;
}

.sidebar-logo {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 24px 0 12px 0;
}

.sidebar-logo-img {
  width: 100%;
  max-width: 180px;
  height: auto;
  display: block;
  object-fit: contain;
}

.menu-list {
  flex: 1;
  padding: 16px 0;
}

.menu-item {
  margin: 4px 12px;
  border-radius: 12px;
  padding: 12px 16px;
  transition: all 0.3s ease;
  background: transparent;
}

.menu-item:hover {
  background: rgba(255, 255, 255, 0.05);
}

.menu-item.active {
  background: linear-gradient(90deg, #00ff88, #00cc6a);
  color: #1a1a1a;
}

.menu-label {
  font-weight: 500;
  color: #ccc;
  font-size: 14px;
}

.menu-label.active {
  color: #1a1a1a;
  font-weight: 600;
}

.support-section {
  padding: 16px;
  border-top: 1px solid #333;
}

.support-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.support-item:hover {
  background: rgba(255, 255, 255, 0.05);
}

.support-text {
  color: #ccc;
  font-size: 14px;
  flex: 1;
}

.support-flag {
  display: flex;
  align-items: center;
}

/* Scrollbar Styling */
:deep(.q-scrollarea__thumb) {
  background: #00ff88;
  border-radius: 4px;
}

:deep(.q-scrollarea__bar) {
  background: rgba(255, 255, 255, 0.1);
}
</style>