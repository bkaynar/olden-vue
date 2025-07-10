<template>
  <q-header elevated class="bg-dark text-white">
    <q-toolbar class="q-px-lg">
      <q-space />

      <!-- Giriş yapmış kullanıcı için profil alanı -->
      <div v-if="isAuthenticated" class="user-profile row items-center q-gutter-sm">
        <div class="user-info">
          <div class="user-name">{{ user.name }}</div>
          <div class="user-balance">{{ user.bakiye }} {{ user.parabirimi }}</div>
        </div>

        <q-btn-dropdown flat round class="user-avatar" dropdown-icon="" auto-close anchor="bottom end" self="top end"
          :content-class="'custom-dropdown'"
          :content-style="{ background: 'transparent', boxShadow: 'none', padding: '0' }">
          <template v-slot:label>
            <q-avatar color="green" text-color="white" size="40px">
              <q-icon name="person" />
            </q-avatar>
          </template>

          <div class="user-dropdown">
            <!-- Kullanıcı Bilgi Alanı -->
            <div class="user-header">
              <div class="user-avatar-large">
                <q-avatar color="green" text-color="white" size="60px">
                  <q-icon name="person" size="32px" />
                </q-avatar>
                <q-btn flat round size="sm" icon="edit" class="edit-btn" color="white" />
              </div>
              <div class="user-details">
                <div class="username">{{ user?.username || user?.name }}</div>
                <div class="user-status">
                  <q-icon name="verified" color="green" size="16px" />
                </div>
              </div>
            </div>

            <!-- Menü Öğeleri -->
            <div class="menu-items">
              <q-item clickable v-close-popup class="menu-item">
                <q-item-section avatar>
                  <q-icon name="person" color="white" size="20px" />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="menu-label">Hesabım</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup class="menu-item">
                <q-item-section avatar>
                  <q-icon name="mail" color="white" size="20px" />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="menu-label">Dekont Gönder</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup class="menu-item">
                <q-item-section avatar>
                  <q-icon name="phone" color="white" size="20px" />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="menu-label">Aranma Talep Et</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup class="menu-item">
                <q-item-section avatar>
                  <q-icon name="group" color="white" size="20px" />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="menu-label">Davet Et & Kazan</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="logout" class="menu-item logout-item">
                <q-item-section avatar>
                  <q-icon name="power_settings_new" color="white" size="20px" />
                </q-item-section>
                <q-item-section>
                  <q-item-label class="menu-label">Çıkış Yap</q-item-label>
                </q-item-section>
              </q-item>
            </div>
          </div>
        </q-btn-dropdown>
      </div>

      <!-- Giriş yapmamış kullanıcı için giriş butonları -->
      <div v-else class="auth-actions row items-center q-gutter-sm">
        <q-btn flat no-caps label="GİRİŞ" class="nav-btn" @click="openLoginModal" />
        <q-btn unelevated no-caps label="Kayıt Ol" class="register-btn" color="green" @click="openRegisterModal" />
      </div>
    </q-toolbar>

    <!-- Auth Modals -->
    <LoginModal v-model="showLoginModal" @switch-to-register="switchToRegister" @login-success="handleLoginSuccess" />

    <RegisterModal v-model="showRegisterModal" @switch-to-login="switchToLogin"
      @register-success="handleRegisterSuccess" />
  </q-header>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import LoginModal from './LoginModal.vue'
import RegisterModal from './RegisterModal.vue'
import { useAuthModals } from '../composables/useAuthModals'
import { useAuth } from '../composables/useAuth'

export default defineComponent({
  name: 'AppHeader',

  components: {
    LoginModal,
    RegisterModal
  },

  setup() {
    const {
      showLoginModal,
      showRegisterModal,
      openLoginModal,
      openRegisterModal,
      switchToRegister,
      switchToLogin,
      handleLoginSuccess,
      handleRegisterSuccess
    } = useAuthModals()

    const { user, isAuthenticated, logout } = useAuth()

    // Login success handler'ı güncelleyelim
    const handleLogin = () => {
      handleLoginSuccess({})
      // Sayfa yenileneceği için user bilgisi otomatik güncellenecek
    }

    return {
      showLoginModal,
      showRegisterModal,
      openLoginModal,
      openRegisterModal,
      switchToRegister,
      switchToLogin,
      handleLoginSuccess: handleLogin,
      handleRegisterSuccess,
      user,
      isAuthenticated,
      logout
    }
  }
})
</script>

<style scoped>
.user-profile {
  margin-right: 16px;
}

.user-info {
  text-align: right;
  margin-right: 12px;
}

.user-name {
  color: white;
  font-weight: 600;
  font-size: 14px;
  line-height: 1.2;
}

.user-balance {
  color: #00ff88;
  font-weight: 500;
  font-size: 12px;
  line-height: 1.2;
}

.user-avatar {
  transition: all 0.3s ease;
}

.user-avatar:hover {
  transform: scale(1.05);
}

/* Dropdown Menü Stilleri */
:deep(.q-menu) {
  background: transparent !important;
  box-shadow: none !important;
  border-radius: 16px !important;
  margin-top: 8px !important;
  padding: 0 !important;
}

:deep(.q-menu .q-menu) {
  background: transparent !important;
}

:deep(.q-menu .q-item) {
  background: transparent !important;
  color: white !important;
}

:deep(.q-menu .q-item:before) {
  display: none !important;
}

:deep(.q-menu .q-item .q-focus-helper) {
  display: none !important;
}

:deep(.q-menu .q-item .q-ripple) {
  display: none !important;
}

.user-dropdown {
  background: #2a2e3a;
  border-radius: 16px;
  padding: 20px;
  min-width: 280px;
  border: 1px solid #3a3e4a;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.8);
}

.user-header {
  display: flex;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 20px;
  border-bottom: 1px solid #3a3e4a;
}

.user-avatar-large {
  position: relative;
  margin-right: 16px;
}

.edit-btn {
  position: absolute;
  bottom: -5px;
  right: -5px;
  background: #2a2e3a;
  border: 2px solid #3a3e4a;
  min-height: 24px;
  width: 24px;
}

.edit-btn:hover {
  background: #3a3e4a;
}

.user-details {
  flex: 1;
}

.username {
  color: white;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 4px;
}

.user-status {
  display: flex;
  align-items: center;
}

.menu-items {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.menu-item {
  padding: 12px 16px;
  border-radius: 12px;
  transition: all 0.3s ease;
  margin: 2px 0;
  background: transparent !important;
}

.menu-item:hover {
  background: #3a3e4a !important;
}

:deep(.menu-item) {
  background: transparent !important;
}

:deep(.menu-item:before) {
  display: none !important;
}

:deep(.menu-item .q-item__section) {
  color: white !important;
  background: transparent !important;
}

:deep(.menu-item .q-focus-helper) {
  display: none !important;
  background: transparent !important;
}

:deep(.menu-item .q-item__section--avatar) {
  min-width: 32px;
  background: transparent !important;
}

:deep(.menu-item .q-ripple) {
  display: none !important;
}

:deep(.menu-item:after) {
  display: none !important;
}

.menu-label {
  color: white;
  font-size: 16px;
  font-weight: 500;
}

.logout-item {
  margin-top: 8px;
  border-top: 1px solid #3a3e4a;
  padding-top: 16px;
  background: transparent !important;
}

.logout-item:hover {
  background: rgba(255, 77, 77, 0.1) !important;
}

.logout-item .menu-label {
  color: #ff6b6b;
}

:deep(.logout-item .q-item__section--avatar .q-icon) {
  color: #ff6b6b !important;
}

.auth-actions {
  /* Butonları sağa hizala */
  margin-right: 16px;
}

.nav-btn {
  color: white;
  font-weight: 500;
  padding: 8px 16px;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.nav-btn:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.register-btn {
  background: #00ff88;
  color: #1a1a1a;
  font-weight: 600;
  padding: 8px 24px;
  border-radius: 20px;
  transition: all 0.3s ease;
}

.register-btn:hover {
  background: #00e077;
  transform: translateY(-1px);
}

.chat-btn {
  background: rgba(255, 255, 255, 0.1);
  color: white;
  transition: all 0.3s ease;
}

.chat-btn:hover {
  background: rgba(255, 255, 255, 0.2);
}

.q-toolbar {
  min-height: 80px;
  background: #20242e;
  border-bottom: 1px solid #333;
}

/* Global overrides for this dropdown */
:deep(.q-dropdown .q-item) {
  background: transparent !important;
}

:deep(.q-dropdown .q-item:before) {
  display: none !important;
}

:deep(.q-dropdown .q-item .q-focus-helper) {
  background: transparent !important;
  display: none !important;
}

:deep(.q-dropdown .q-item:hover) {
  background: #3a3e4a !important;
}

:deep(.q-dropdown .q-item__section) {
  background: transparent !important;
}

/* Custom dropdown class */
:deep(.custom-dropdown) {
  background: transparent !important;
  box-shadow: none !important;
  padding: 0 !important;
}

:deep(.custom-dropdown .q-item) {
  background: transparent !important;
}

:deep(.custom-dropdown .q-item:before) {
  display: none !important;
}

/* Mobile adjustments */
@media (max-width: 1023px) {
  .q-toolbar {
    min-height: 60px;
    padding: 0 16px;
  }

  .user-profile,
  .auth-actions {
    margin-right: 0;
  }

  .user-info {
    display: none;
    /* Mobilde sadece avatar göster */
  }

  .nav-btn,
  .register-btn {
    padding: 6px 12px;
    font-size: 14px;
  }

  .register-btn {
    padding: 6px 16px;
  }
}
</style>