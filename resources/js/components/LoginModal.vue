<template>
  <q-dialog
    :model-value="modelValue"
    @update:model-value="$emit('update:modelValue', $event)"
    persistent
  >
    <q-card class="login-modal">
      <q-card-section class="modal-header">
        <div class="header-content">
          <img src="/images/logon.png" alt="Logo" class="modal-logo" />
          <q-btn
            flat
            round
            dense
            icon="close"
            class="close-btn"
            @click="closeModal"
          />
        </div>
      </q-card-section>

      <q-card-section class="modal-body">
        <div class="form-title">
          <h3>Giriş Yap</h3>
          <p>Hesabınıza giriş yapın ve kazanmaya başlayın!</p>
        </div>

        <q-form @submit.prevent="handleLogin" class="login-form">
          <!-- Username -->
          <div class="form-group">
            <q-input
              v-model="form.username"
              name="username"
              label="Kullanıcı Adı"
              outlined
              dense
              class="custom-input"
              :error="!!form.errors.username"
              :error-message="form.errors.username"
            >
              <template v-slot:prepend>
                <q-icon name="person" color="green" />
              </template>
            </q-input>
          </div>

          <!-- Password -->
          <div class="form-group">
            <q-input
              v-model="form.password"
              name="password"
              :type="showPassword ? 'text' : 'password'"
              label="Şifre"
              outlined
              dense
              class="custom-input"
              :error="!!form.errors.password"
              :error-message="form.errors.password"
            >
              <template v-slot:prepend>
                <q-icon name="lock" color="green" />
              </template>
              <template v-slot:append>
                <q-icon
                  :name="showPassword ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="showPassword = !showPassword"
                />
              </template>
            </q-input>
          </div>

          <!-- Remember & Forgot -->
          <div class="form-options">
            <div></div>
            <q-btn
              flat
              no-caps
              class="forgot-password"
              label="Şifremi Unuttum"
              @click="forgotPassword"
            />
          </div>

          <!-- Submit -->
          <q-btn
            type="submit"
            class="login-btn"
            label="Giriş Yap"
            no-caps
            :loading="form.processing"
            :disable="form.processing"
          />
        </q-form>
      </q-card-section>

      <q-card-section class="modal-footer">
        <div class="register-link">
          <span>Hesabınız yok mu?</span>
          <q-btn
            flat
            no-caps
            class="register-btn"
            label="Kayıt Ol"
            @click="switchToRegister"
          />
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

interface Props {
  modelValue: boolean
}
defineProps<Props>()
const emit = defineEmits<{
  (e: 'update:modelValue', v: boolean): void
  (e: 'switch-to-register'): void
  (e: 'login-success'): void
}>()

// Form’u username ile kuruyoruz
const form = useForm({
  username: '',
  password: '',
})

const showPassword = ref(false)

const closeModal = () => {
  emit('update:modelValue', false)
}

const handleLogin = () => {
  form.post(route('user.login'), {
    onSuccess: () => {
      emit('login-success')
      closeModal()
    },
    onError: (errors) => {
      console.error('Login errors:', errors)
    },
    onFinish: () => {
      form.reset('password')
    },
  })
}

const switchToRegister = () => emit('switch-to-register')

const forgotPassword = () => {
  window.location.href = route('password.request')
}
</script>

<style scoped>
/* Stil tanımlarınız aynı kalabilir */
</style>

<style scoped>
.login-modal {
    width: 100%;
    max-width: 440px;
    background: #1e222a;
    border-radius: 16px;
    border: 1px solid #333;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.modal-header {
    padding: 24px 24px 0 24px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-logo {
    height: 40px;
    object-fit: contain;
}

.close-btn {
    color: #888;
    transition: color 0.3s ease;
}

.close-btn:hover {
    color: #fff;
}

.modal-body {
    padding: 24px;
}

.form-title {
    text-align: center;
    margin-bottom: 32px;
}

.form-title h3 {
    color: #fff;
    font-size: 28px;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.form-title p {
    color: #888;
    font-size: 16px;
    margin: 0;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    width: 100%;
}

:deep(.custom-input .q-field__control) {
    background: #2a2f3a;
    border-radius: 12px;
    color: #fff;
}

:deep(.custom-input .q-field__label) {
    color: #888;
}

:deep(.custom-input .q-field__native) {
    color: #fff;
}

:deep(.custom-input.q-field--focused .q-field__control) {
    border-color: #00ff88;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
}

.remember-checkbox {
    color: #888;
}

.forgot-password {
    color: #00ff88;
    font-size: 14px;
    padding: 4px 8px;
}

.forgot-password:hover {
    color: #00cc6a;
}

.login-btn {
    width: 100%;
    height: 48px;
    background: linear-gradient(90deg, #00ff88 0%, #00cc6a 100%);
    color: #1a1a1a;
    font-weight: 600;
    font-size: 16px;
    border-radius: 12px;
    margin-top: 8px;
    box-shadow: 0 4px 16px rgba(0, 255, 136, 0.3);
}

.login-btn:hover {
    box-shadow: 0 6px 20px rgba(0, 255, 136, 0.4);
}

.modal-footer {
    padding: 0 24px 24px 24px;
}

.register-link {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    color: #888;
}

.register-btn {
    color: #00ff88;
    font-weight: 600;
    padding: 4px 8px;
}

.register-btn:hover {
    color: #00cc6a;
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .login-modal {
        margin: 16px;
        max-width: calc(100vw - 32px);
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 20px;
    }

    .form-title h3 {
        font-size: 24px;
    }

    .form-title p {
        font-size: 14px;
    }

    .form-options {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
}
</style>
