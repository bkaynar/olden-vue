<template>
  <header class="header--9KA5L">
    <div class="flex--FROoX panel--Z3hs5">
      <div class="logo--fV2t3"><a class="logo-container--I_EVs" href="/tr-tr/"></a></div>
      <div class="buttons--xhcFd">
        <div class="btn-login--z_RH_">
          <div class="ellipsis--_PsgU">GİRİŞ</div>
        </div>
        <div class="btn-join-now--SG3v1">
          <div class="ellipsis--_PsgU">Kayıt ol</div>
        </div><button class="chat-button--cupkJ"><span class="wrapper--xQUxI"
            style="height: 16px; width: 16px; min-width: 16px;"><svg width="18" height="18" viewBox="0 0 18 18"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M6.46223 14.7661L6.24241 14.5456H5.931H1.8C1.52145 14.5456 1.25436 14.4349 1.05746 14.2381C0.860572 14.0413 0.75 13.7744 0.75 13.4961V1.79948C0.75 1.52121 0.860572 1.25429 1.05746 1.05746C1.25436 0.860623 1.52145 0.75 1.8 0.75H16.2C16.4785 0.75 16.7456 0.860622 16.9425 1.05746C17.1394 1.25429 17.25 1.52121 17.25 1.79948V13.4961C17.25 13.7744 17.1394 14.0413 16.9425 14.2381C16.7456 14.4349 16.4785 14.5456 16.2 14.5456H12.069H11.7576L11.5378 14.7661L9.10777 17.2044L9.10658 17.2056C9.09264 17.2197 9.07605 17.2308 9.05776 17.2385C9.03947 17.2461 9.01984 17.25 9 17.25C8.98016 17.25 8.96053 17.2461 8.94225 17.2385C8.92395 17.2308 8.90736 17.2197 8.89343 17.2056L8.89223 17.2044L6.46223 14.7661Z"
                stroke="currentColor" stroke-width="1.5"></path>
              <path
                d="M6.75 7.5C6.75 8.32843 6.07843 9 5.25 9C4.42157 9 3.75 8.32843 3.75 7.5C3.75 6.67157 4.42157 6 5.25 6C6.07843 6 6.75 6.67157 6.75 7.5Z"
                fill="currentColor"></path>
              <path
                d="M10.5 7.5C10.5 8.32843 9.82843 9 9 9C8.17157 9 7.5 8.32843 7.5 7.5C7.5 6.67157 8.17157 6 9 6C9.82843 6 10.5 6.67157 10.5 7.5Z"
                fill="currentColor"></path>
              <path
                d="M14.25 7.5C14.25 8.32843 13.5784 9 12.75 9C11.9216 9 11.25 8.32843 11.25 7.5C11.25 6.67157 11.9216 6 12.75 6C13.5784 6 14.25 6.67157 14.25 7.5Z"
                fill="currentColor"></path>
            </svg></span></button>
      </div>
    </div>
  </header>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import LoginModal from './LoginModal.vue'
import RegisterModal from './RegisterModal.vue'
import { useAuthModals } from '../composables/useAuthModals'
import { useAuth } from '../composables/useAuth'
import { usePage } from '@inertiajs/vue3'

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
    const page = usePage()
    const logoSrc = (page.props.siteLogo as string) || '/images/logon.png'

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
      logout,
      logoSrc
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
  min-height: 70px;
  background: #20242e;
  border-bottom: 1px solid #333;
}

:deep(.q-header) {
  z-index: 1000;
  position: fixed;
  width: 100%;
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

.header-logo {
  display: flex;
  align-items: center;
  margin-right: 24px;
}

.logo-img {
  height: 40px;
  width: auto;
  max-width: 120px;
}

@media (max-width: 1023px) {
  .logo-img {
    height: 32px;
    max-width: 100px;
  }

  .auth-actions {
    justify-content: flex-end;
    width: 100%;
  }
}

/* Mobile adjustments */
@media (max-width: 1023px) {
  .q-toolbar {
    min-height: 60px;
    padding: 0 16px;
  }

  .header-logo {
    margin-right: 16px;
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