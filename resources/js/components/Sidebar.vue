<template>
  <q-drawer
    v-model="drawer"
    side="left"
    :width="260"
    show-if-above
    :breakpoint="1024"
    class="baywin-sidebar"
  >
    <div class="sidebar-container">

      <!-- Menu Items -->
      <div class="menu-section">
        <!-- Ana Sayfa - Active -->
        <div class="menu-item active" @click="selectMenuItem('home')">
          <div class="menu-icon-wrapper active">
            <q-icon name="home" class="menu-icon" />
          </div>
          <span class="menu-label">Ana Sayfa</span>
        </div>

        <!-- Spor Bahisleri -->
        <div class="menu-item" @click="selectMenuItem('sports')">
          <div class="menu-icon-wrapper">
            <q-icon name="sports_soccer" class="menu-icon" />
          </div>
          <span class="menu-label">Spor Bahisleri</span>
        </div>

        <!-- Canlı Bahis -->
        <div class="menu-item" @click="selectMenuItem('live')">
          <div class="menu-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
            </svg>
          </div>
          <span class="menu-label">Canlı Bahis</span>
        </div>

        <!-- Turnuvalar -->
        <div class="menu-item" @click="selectMenuItem('tournaments')">
          <div class="menu-icon-wrapper">
            <q-icon name="emoji_events" class="menu-icon" />
          </div>
          <span class="menu-label">Turnuvalar</span>
        </div>

        <!-- Casino -->
        <div class="menu-item" @click="selectMenuItem('casino')">
          <div class="menu-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M9,8A1,1 0 0,0 8,9A1,1 0 0,0 9,10A1,1 0 0,0 10,9A1,1 0 0,0 9,8M15,8A1,1 0 0,0 14,9A1,1 0 0,0 15,10A1,1 0 0,0 16,9A1,1 0 0,0 15,8M9,14A1,1 0 0,0 8,15A1,1 0 0,0 9,16A1,1 0 0,0 10,15A1,1 0 0,0 9,14M15,14A1,1 0 0,0 14,15A1,1 0 0,0 15,16A1,1 0 0,0 16,15A1,1 0 0,0 15,14Z"/>
            </svg>
          </div>
          <span class="menu-label">Casino</span>
        </div>

        <!-- Tapking -->
        <div class="menu-item" @click="selectMenuItem('tapking')">
          <div class="menu-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6L9,9H11V15H13V9H15L12,6Z"/>
            </svg>
          </div>
          <span class="menu-label">Tapking</span>
        </div>

        <!-- Canlı Casino -->
        <div class="menu-item" @click="selectMenuItem('livecasino')">
          <div class="menu-icon-wrapper">
            <q-icon name="videocam" class="menu-icon" />
          </div>
          <span class="menu-label">Canlı Casino</span>
        </div>

        <!-- Baywin Originals -->
        <div class="menu-item" @click="selectMenuItem('originals')">
          <div class="menu-icon-wrapper baywin-original">
            <div class="w-icon">W</div>
          </div>
          <span class="menu-label">Baywin Originals</span>
        </div>

        <!-- Oyunlar -->
        <div class="menu-item" @click="selectMenuItem('games')">
          <div class="menu-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7,6H17A6,6 0 0,1 23,12A6,6 0 0,1 17,18C15.22,18 13.63,17.23 12.53,16H11.47C10.37,17.23 8.78,18 7,18A6,6 0 0,1 1,12A6,6 0 0,1 7,6M6,9V11H4V13H6V15H8V13H10V11H8V9H6M15.5,12A1.5,1.5 0 0,0 14,10.5A1.5,1.5 0 0,0 12.5,12A1.5,1.5 0 0,0 14,13.5A1.5,1.5 0 0,0 15.5,12M18.5,10.5A1.5,1.5 0 0,0 17,9A1.5,1.5 0 0,0 15.5,10.5A1.5,1.5 0 0,0 17,12A1.5,1.5 0 0,0 18.5,10.5Z"/>
            </svg>
          </div>
          <span class="menu-label">Oyunlar</span>
        </div>

        <!-- E-Spor -->
        <div class="menu-item" @click="selectMenuItem('esports')">
          <div class="menu-icon-wrapper">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2M21,11C21,16.55 17.16,21.74 12,22C6.84,21.74 3,16.55 3,11V5A2,2 0 0,1 5,3H19A2,2 0 0,1 21,5V11Z"/>
            </svg>
          </div>
          <span class="menu-label">E-Spor</span>
        </div>

        <!-- Sanal Bahis -->
        <div class="menu-item" @click="selectMenuItem('virtual')">
          <div class="menu-icon-wrapper">
            <q-icon name="computer" class="menu-icon" />
          </div>
          <span class="menu-label">Sanal Bahis</span>
        </div>
      </div>

      <!-- Bottom Section -->
      <div class="bottom-section">
        <!-- Canlı Destek -->
        <div class="support-item">
          <span class="support-text">Canlı Destek</span>
          <div class="country-selector">
            <div class="tr-flag"></div>
            <q-icon name="keyboard_arrow_down" size="16px" />
          </div>
        </div>
      </div>
    </div>
  </q-drawer>
</template>

<script setup>
import { ref } from 'vue'
import { useQuasar } from 'quasar'

const $q = useQuasar()
const drawer = ref($q.screen.gt.lg)

const activeMenuItem = ref('home')

const selectMenuItem = (menuName) => {
  activeMenuItem.value = menuName
  console.log('Selected:', menuName)
}
</script>

<style scoped>
.baywin-sidebar {
  background: linear-gradient(180deg, #2c2f3a 0%, #252832 100%);
  border-right: 2px solid #00ff88;
  font-family: 'Gilroy', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.sidebar-container {
  height: 100%;
  display: flex;
  flex-direction: column;
  background: linear-gradient(180deg, #2c2f3a 0%, #252832 100%);
  padding: 0;
}

/* Logo Section */
.logo-section {
  padding: 24px 24px 32px 24px;
  border-bottom: none;
}

.logo-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-image {
  max-width: 100%;
  height: auto;
  max-height: 60px;
}

/* Menu Section */
.menu-section {
  flex: 1;
  padding: 16px 16px 20px 16px;
  display: flex;
  flex-direction: column;
  gap: 0;
  overflow-y: auto;
}

.menu-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 25px;
  cursor: pointer;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  min-height: 48px;
  background: #161922;
  border: none;
  margin-bottom: 4px;
}

.menu-item:hover {
  background: rgba(0, 255, 136, 0.08);
  transform: translateX(2px);
  border-color: rgba(0, 255, 136, 0.2);
}

.menu-item.active {
  background: linear-gradient(90deg, #00ff88 0%, #00e680 100%);
  box-shadow: 0 4px 20px rgba(0, 255, 136, 0.3);
  transform: none;
  border: none;
  margin-bottom: 4px;
}

.menu-icon-wrapper {
  width: 36px;
  height: 36px;
  background: rgba(255, 255, 255, 0.08);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.menu-icon-wrapper.active {
  background: rgba(0, 0, 0, 0.3);
}

.menu-icon-wrapper.baywin-original {
  background: rgba(0, 255, 136, 0.15);
  border: 1px solid rgba(0, 255, 136, 0.3);
}

.menu-icon {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.7);
}

.menu-item.active .menu-icon {
  color: #000;
}

.w-icon {
  width: 18px;
  height: 18px;
  background: rgba(0, 0, 0, 0.8);
  border-radius: 3px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 11px;
  color: #00ff88;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.menu-item.active .w-icon {
  background: rgba(0, 0, 0, 0.9);
  color: #00ff88;
}

.menu-label {
  font-size: 16px;
  font-weight: 600;
  color: #ffffff;
  flex: 1;
  letter-spacing: 1.2px;
  text-overflow: ellipsis;
  max-width: calc(100% - 50px);
  font-family: 'Gilroy', sans-serif;
}

.menu-item.active .menu-label {
  color: #000;
  font-weight: 600;
  text-shadow: none;
}

/* Bottom Section */
.bottom-section {
  padding: 24px 24px 28px 24px;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  margin-top: auto;
}

.support-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 2px 0;
}

.support-text {
  color: rgba(255, 255, 255, 0.65);
  font-size: 15px;
  font-weight: 500;
  font-family: 'Gilroy', sans-serif;
}

.country-selector {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 8px 10px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.country-selector:hover {
  background: rgba(0, 255, 136, 0.08);
  border-color: rgba(0, 255, 136, 0.2);
}

.tr-flag {
  width: 20px;
  height: 14px;
  background: linear-gradient(180deg, #e30a17 0%, #e30a17 100%);
  border-radius: 2px;
  position: relative;
}

.tr-flag::before {
  content: '';
  position: absolute;
  left: 3px;
  top: 3px;
  width: 6px;
  height: 6px;
  border: 1px solid white;
  border-radius: 50%;
  background: transparent;
}

.tr-flag::after {
  content: '★';
  position: absolute;
  right: 2px;
  top: 2px;
  color: white;
  font-size: 8px;
}

/* Scrollbar */
.menu-section::-webkit-scrollbar {
  width: 4px;
}

.menu-section::-webkit-scrollbar-track {
  background: transparent;
}

.menu-section::-webkit-scrollbar-thumb {
  background: rgba(0, 255, 136, 0.3);
  border-radius: 2px;
}

/* SVG Icons Color */
.menu-item:not(.active) svg {
  color: rgba(255, 255, 255, 0.7);
  width: 16px;
  height: 16px;
}

.menu-item.active svg {
  color: #000;
  width: 16px;
  height: 16px;
}

/* Responsive */
@media (max-width: 1024px) {
  .baywin-sidebar {
    background: rgba(42, 45, 55, 0.95);
    backdrop-filter: blur(10px);
  }
}
</style>