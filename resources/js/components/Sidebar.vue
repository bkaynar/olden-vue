<template>
  <q-drawer v-model="drawer" show-if-above :width="280" class="bg-dark" side="left" bordered>
    <div class="sidebar-content">
      <!-- Logo (Sticky) -->
      <div class="sidebar-logo sticky-logo">
        <img src="/images/logon.png" alt="Logo" class="sidebar-logo-img" />
      </div>
      <!-- Scrollable Menu/Profile Alanı -->
      <div class="sidebar-scrollable">
        <q-list class="menu-list">
          <q-item v-for="item in menuItems" :key="item.name" :class="['menu-item', { active: item.active }]" clickable
            @click="selectMenuItem(item)">
            <div class="accent-bar" v-if="item.active"></div>
            <q-item-section avatar>
              <div :class="['icon-bubble', { active: item.active }]">
                <q-icon :name="item.icon" :color="item.active ? 'white' : 'green'" size="md" />
              </div>
            </q-item-section>
            <q-item-section>
              <q-item-label :class="['menu-label', { active: item.active }]">
                {{ item.label }}
              </q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
        <!-- User Profile (Dummy) -->
        <div class="sidebar-profile">
          <q-avatar size="40px">
            <img src="https://cdn.quasar.dev/img/avatar.png" alt="Kullanıcı" />
          </q-avatar>
          <div class="profile-info">
            <div class="profile-name">Kullanıcı Adı</div>
            <div class="profile-role">VIP Üye</div>
          </div>
        </div>
      </div>
      <!-- Canlı Destek (Sticky) -->
      <div class="support-section sticky-support">
        <q-btn class="support-btn" color="green" icon="headset_mic" label="Canlı Destek" flat rounded />
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
  position: relative;
}

.sticky-logo {
  position: sticky;
  top: 0;
  z-index: 10;
  background: #20242e;
  border-bottom: 1px solid #222;
}

.sidebar-scrollable {
  flex: 1;
  overflow-y: auto;
  min-height: 0;
  display: flex;
  flex-direction: column;
}

.sticky-support {
  position: sticky;
  bottom: 0;
  z-index: 10;
  background: #20242e;
  border-top: 1px solid #222;
}

.sidebar-logo {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 0 6px 0;
  /* üst boşluk azaltıldı */
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
  padding: 8px 0;
}

.menu-item {
  margin: 4px 12px;
  border-radius: 12px;
  padding: 6px 16px 6px 8px;
  transition: all 0.3s cubic-bezier(.4, 2, .3, 1);
  background: transparent;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
}

.menu-item:hover {
  background: rgba(0, 255, 136, 0.07);
}

.menu-item.active {
  background: linear-gradient(90deg, #00ff88 0%, #00cc6a 100%);
  color: #1a1a1a;
  box-shadow: 0 4px 24px 0 rgba(0, 255, 136, 0.10);
}

.menu-label {
  font-weight: 500;
  color: #ccc;
  font-size: 15px;
  letter-spacing: 0.2px;
}

.menu-label.active {
  color: #1a1a1a;
  font-weight: 600;
}

.icon-bubble {
  background: #23272f;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.3s;
}

.icon-bubble.active {
  background: linear-gradient(135deg, #00ff88 0%, #00cc6a 100%);
  box-shadow: 0 2px 8px 0 rgba(0, 255, 136, 0.15);
}

.accent-bar {
  position: absolute;
  left: 0;
  top: 10px;
  bottom: 10px;
  width: 5px;
  border-radius: 6px;
  background: linear-gradient(180deg, #00ff88 0%, #00cc6a 100%);
  box-shadow: 0 0 8px #00ff8844;
}

.sidebar-profile {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 18px 16px 8px 16px;
  border-top: 1px solid #222;
  border-bottom: 1px solid #222;
  margin: 0 0 8px 0;
}

.profile-info {
  display: flex;
  flex-direction: column;
}

.profile-name {
  color: #fff;
  font-weight: 600;
  font-size: 15px;
}

.profile-role {
  color: #00ff88;
  font-size: 13px;
  font-weight: 500;
}

.support-section {
  padding: 18px 16px 16px 16px;
  border-top: 1px solid #333;
}

.support-btn {
  width: 100%;
  font-weight: 600;
  font-size: 15px;
  border-radius: 12px;
  box-shadow: 0 2px 12px 0 rgba(0, 255, 136, 0.10);
  letter-spacing: 0.2px;
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