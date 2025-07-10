<template>
  <q-header elevated class="bg-dark text-white">
    <q-toolbar class="q-px-lg">
      <q-space />
      <div class="auth-actions row items-center q-gutter-sm">
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

    return {
      showLoginModal,
      showRegisterModal,
      openLoginModal,
      openRegisterModal,
      switchToRegister,
      switchToLogin,
      handleLoginSuccess,
      handleRegisterSuccess
    }
  }
})
</script>

<style scoped>
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

  .auth-actions {
    margin-right: 0;
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