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

        <q-btn-dropdown flat round class="user-avatar">
          <template v-slot:label>
            <q-avatar color="green" text-color="white" size="40px">
              <q-icon name="person" />
            </q-avatar>
          </template>

          <q-list>
            <q-item clickable v-close-popup>
              <q-item-section avatar>
                <q-icon name="account_circle" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Profil</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable v-close-popup>
              <q-item-section avatar>
                <q-icon name="account_balance_wallet" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Bakiye</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable v-close-popup>
              <q-item-section avatar>
                <q-icon name="settings" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Ayarlar</q-item-label>
              </q-item-section>
            </q-item>

            <q-separator />

            <q-item clickable v-close-popup @click="logout">
              <q-item-section avatar>
                <q-icon name="logout" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Çıkış Yap</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
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