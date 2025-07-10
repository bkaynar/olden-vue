<template>
  <q-header elevated class="bg-dark text-white">
    <q-toolbar class="q-px-lg">
      <q-space />
      <div class="auth-actions row items-center q-gutter-sm">
        <q-btn flat no-caps label="GİRİŞ" class="nav-btn" @click="showLogin" />
        <q-btn unelevated no-caps label="Kayıt Ol" class="register-btn" color="green" @click="showRegister" />
        <q-btn flat round icon="chat" class="chat-btn" @click="openChat" />
      </div>
    </q-toolbar>
  </q-header>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'AppHeader',
  methods: {
    showLogin() {
      console.log('Login clicked')
    },
    showRegister() {
      console.log('Register clicked')
    },
    openChat() {
      console.log('Chat clicked')
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
</style>