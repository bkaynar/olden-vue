<template>  <q-dialog :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" persistent>    <q-card class="register-modal">      <q-card-section class="modal-header">        <div class="header-content">          <img src="/images/logon.png" alt="Logo" class="modal-logo" />          <q-btn flat round dense icon="close" class="close-btn" @click="closeModal" />        </div>      </q-card-section>      <q-card-section class="modal-body">        <div class="form-title">          <h3>Kayıt Ol</h3>          <p>Hemen üye olun ve büyük kazançların tadını çıkarın!</p>        </div>        <!-- Step Progress -->        <div class="step-progress">          <div class="progress-bar">            <div class="progress-fill" :style="{ width: currentStep === 1 ? '50%' : '100%' }"></div>          </div>          <div class="step-indicators">            <div :class="['step-indicator', { active: currentStep >= 1 }]">              <span>1</span>              <label>Kişisel Bilgiler</label>            </div>            <div :class="['step-indicator', { active: currentStep >= 2 }]">              <span>2</span>              <label>İletişim Bilgileri</label>            </div>          </div>        </div>        <!-- Step 1: Personal Information -->        <div v-if="currentStep === 1" class="step-content">          <q-form @submit="nextStep" class="register-form">            <div class="form-row">              <div class="form-group">                <q-input                   v-model="registerForm.firstName"                   label="Ad"                   outlined                   dense                   class="custom-input"                  :rules="[val => !!val || 'Ad gerekli']"                >                  <template v-slot:prepend>                    <q-icon name="person" color="green" />                  </template>                </q-input>              </div>              <div class="form-group">                <q-input                   v-model="registerForm.lastName"                   label="Soyad"                   outlined                   dense                   class="custom-input"                  :rules="[val => !!val || 'Soyad gerekli']"                >                  <template v-slot:prepend>                    <q-icon name="person_outline" color="green" />                  </template>                </q-input>              </div>            </div>            <div class="form-group">              <q-input                 v-model="registerForm.username"                 label="Kullanıcı Adı"                 outlined                 dense                class="custom-input"                :rules="[val => !!val || 'Kullanıcı adı gerekli', val => val.length >= 3 || 'En az 3 karakter olmalı']"              >                <template v-slot:prepend>                  <q-icon name="account_circle" color="green" />                </template>              </q-input>            </div>
            <div class="form-group">
              <q-input 
                v-model="registerForm.email" 
                label="E-posta" 
                type="email" 
                outlined 
                dense
                class="custom-input" 
                :rules="[val => !!val || 'E-posta gerekli', isValidEmail]"
              >
                <template v-slot:prepend>
                  <q-icon name="email" color="green" />
                </template>
              </q-input>
            </div>

            <div class="form-row">
              <div class="form-group">
                <q-input 
                  v-model="registerForm.password" 
                  :type="showPassword ? 'text' : 'password'"
                  label="Şifre" 
                  outlined 
                  dense 
                  class="custom-input"
                  :rules="[val => !!val || 'Şifre gerekli', val => val.length >= 6 || 'En az 6 karakter olmalı']"
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

              <div class="form-group">
                <q-input 
                  v-model="registerForm.confirmPassword"
                  :type="showConfirmPassword ? 'text' : 'password'" 
                  label="Şifre Tekrar" 
                  outlined 
                  dense
                  class="custom-input"
                  :rules="[val => !!val || 'Şifre tekrarı gerekli', val => val === registerForm.password || 'Şifreler eşleşmiyor']"
                >
                  <template v-slot:prepend>
                    <q-icon name="lock_outline" color="green" />
                  </template>
                  <template v-slot:append>
                    <q-icon
                      :name="showConfirmPassword ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer" 
                      @click="showConfirmPassword = !showConfirmPassword" 
                    />
                  </template>
                </q-input>
              </div>
            </div>

            <div class="form-group">
              <q-select 
                v-model="registerForm.currency" 
                :options="currencyOptions" 
                label="Para Birimi"
                outlined 
                dense 
                class="custom-input" 
                emit-value 
                map-options
                :rules="[val => !!val || 'Para birimi seçimi gerekli']"
              >
                <template v-slot:prepend>
                  <q-icon name="monetization_on" color="green" />
                </template>
              </q-select>
            </div>

            <div class="form-actions">
              <q-btn type="submit" class="next-btn" label="Devam Et" no-caps icon-right="arrow_forward" />
            </div>
          </q-form>
        </div>

        <!-- Step 2: Contact Information -->
        <div v-if="currentStep === 2" class="step-content">
          <q-form @submit="handleRegister" class="register-form">
            <div class="form-group">
              <q-input 
                v-model="registerForm.phone" 
                label="Telefon" 
                outlined 
                dense 
                class="custom-input"
                mask="+90 (###) ### ## ##" 
                :rules="[val => !!val || 'Telefon gerekli']"
              >
                <template v-slot:prepend>
                  <q-icon name="phone" color="green" />
                </template>
              </q-input>
            </div>

            <div class="form-row">
              <div class="form-group">
                <q-input 
                  v-model="registerForm.postalCode" 
                  label="Posta Kodu" 
                  outlined 
                  dense
                  class="custom-input" 
                  mask="#####" 
                  :rules="[val => !!val || 'Posta kodu gerekli']"
                >
                  <template v-slot:prepend>
                    <q-icon name="location_on" color="green" />
                  </template>
                </q-input>
              </div>

              <div class="form-group">
                <q-select 
                  v-model="registerForm.city" 
                  :options="cityOptions" 
                  label="İl" 
                  outlined 
                  dense
                  class="custom-input" 
                  emit-value 
                  map-options
                  :rules="[val => !!val || 'İl seçimi gerekli']" 
                  @update:model-value="onCityChange"
                >
                  <template v-slot:prepend>
                    <q-icon name="location_city" color="green" />
                  </template>
                </q-select>
              </div>
            </div>

            <div class="form-group">
              <q-select 
                v-model="registerForm.district" 
                :options="districtOptions" 
                label="İlçe" 
                outlined
                dense 
                class="custom-input" 
                emit-value 
                map-options
                :rules="[val => !!val || 'İlçe seçimi gerekli']" 
                :disable="!registerForm.city"
              >
                <template v-slot:prepend>
                  <q-icon name="place" color="green" />
                </template>
              </q-select>
            </div>

            <div class="form-row">
              <div class="form-group">
                <q-input 
                  v-model="registerForm.birthDate" 
                  label="Doğum Tarihi" 
                  outlined 
                  dense
                  class="custom-input" 
                  mask="##/##/####" 
                  placeholder="GG/AA/YYYY"
                  :rules="[val => !!val || 'Doğum tarihi gerekli']"
                >
                  <template v-slot:prepend>
                    <q-icon name="cake" color="green" />
                  </template>
                </q-input>
              </div>

              <div class="form-group">
                <q-input 
                  v-model="registerForm.tcNo" 
                  label="TC Kimlik No" 
                  outlined 
                  dense
                  class="custom-input" 
                  mask="###########"
                  :rules="[val => !!val || 'TC Kimlik No gerekli', val => val.length === 11 || 'TC Kimlik No 11 haneli olmalı']"
                >
                  <template v-slot:prepend>
                    <q-icon name="credit_card" color="green" />
                  </template>
                </q-input>
              </div>
            </div>

            <div class="form-options">
              <q-checkbox 
                v-model="registerForm.acceptTerms" 
                color="green" 
                class="terms-checkbox"
              >
                <span class="terms-text">
                  <a href="#" @click.prevent="openTerms" class="terms-link">Kullanım Şartları</a>'nı
                  ve
                  <a href="#" @click.prevent="openPrivacy" class="terms-link">Gizlilik Politikası</a>'nı kabul ediyorum
                </span>
              </q-checkbox>

              <q-checkbox 
                v-model="registerForm.acceptMarketing" 
                color="green" 
                class="marketing-checkbox"
                label="Promosyon ve kampanya bilgilerini almak istiyorum" 
              />
            </div>

            <div class="form-actions">
              <q-btn flat class="back-btn" label="Geri" no-caps icon="arrow_back" @click="previousStep" />
              <q-btn 
                type="submit" 
                class="register-btn" 
                label="Kayıt Ol" 
                no-caps 
                :loading="loading"
                :disable="!registerForm.acceptTerms" 
              />
            </div>
          </q-form>
        </div>
      </q-card-section>

      <q-card-section class="modal-footer">
        <div class="login-link">
          <span>Zaten hesabınız var mı?</span>
          <q-btn flat no-caps class="login-btn" label="Giriş Yap" @click="switchToLogin" />
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script lang="ts">
import { defineComponent, ref, computed } from 'vue'

interface RegisterForm {
  firstName: string
  lastName: string
  username: string
  email: string
  password: string
  confirmPassword: string
  currency: string
  phone: string
  postalCode: string
  city: string
  district: string
  birthDate: string
  tcNo: string
  acceptTerms: boolean
  acceptMarketing: boolean
}

export default defineComponent({
  name: 'RegisterModal',

  props: {
    modelValue: {
      type: Boolean,
      required: true
    }
  },

  emits: ['update:modelValue', 'switch-to-login', 'register-success'],

  setup(props, { emit }) {
    const registerForm = ref<RegisterForm>({
      firstName: '',
      lastName: '',
      username: '',
      email: '',
      password: '',
      confirmPassword: '',
      currency: '',
      phone: '',
      postalCode: '',
      city: '',
      district: '',
      birthDate: '',
      tcNo: '',
      acceptTerms: false,
      acceptMarketing: false
    })

    const currentStep = ref(1)
    const showPassword = ref(false)
    const showConfirmPassword = ref(false)
    const loading = ref(false)

    // Currency Options
    const currencyOptions = [
      { label: 'Türk Lirası (TRY)', value: 'TRY' },
      { label: 'Euro (EUR)', value: 'EUR' },
      { label: 'Amerikan Doları (USD)', value: 'USD' }
    ]

    // City Options (Simplified)
    const cityOptions = [
      { label: 'İstanbul', value: 'istanbul' },
      { label: 'Ankara', value: 'ankara' },
      { label: 'İzmir', value: 'izmir' },
      { label: 'Bursa', value: 'bursa' },
      { label: 'Antalya', value: 'antalya' },
      { label: 'Adana', value: 'adana' },
      { label: 'Konya', value: 'konya' },
      { label: 'Gaziantep', value: 'gaziantep' },
      { label: 'Mersin', value: 'mersin' },
      { label: 'Kayseri', value: 'kayseri' }
    ]

    // District Options (Based on selected city)
    const districtOptionsMap: Record<string, Array<{ label: string; value: string }>> = {
      istanbul: [
        { label: 'Kadıköy', value: 'kadikoy' },
        { label: 'Beşiktaş', value: 'besiktas' },
        { label: 'Şişli', value: 'sisli' },
        { label: 'Beyoğlu', value: 'beyoglu' },
        { label: 'Üsküdar', value: 'uskudar' }
      ],
      ankara: [
        { label: 'Çankaya', value: 'cankaya' },
        { label: 'Keçiören', value: 'kecioren' },
        { label: 'Yenimahalle', value: 'yenimahalle' },
        { label: 'Mamak', value: 'mamak' }
      ],
      izmir: [
        { label: 'Konak', value: 'konak' },
        { label: 'Karşıyaka', value: 'karsiyaka' },
        { label: 'Bornova', value: 'bornova' },
        { label: 'Buca', value: 'buca' }
      ]
    }

    const districtOptions = computed(() => {
      return districtOptionsMap[registerForm.value.city] || []
    })

    const closeModal = () => {
      currentStep.value = 1
      registerForm.value = {
        firstName: '',
        lastName: '',
        username: '',
        email: '',
        password: '',
        confirmPassword: '',
        currency: '',
        phone: '',
        postalCode: '',
        city: '',
        district: '',
        birthDate: '',
        tcNo: '',
        acceptTerms: false,
        acceptMarketing: false
      }
      emit('update:modelValue', false)
    }

    const isValidEmail = (email: string) => {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailPattern.test(email) || 'Geçerli bir e-posta adresi girin'
    }

    const nextStep = () => {
      currentStep.value = 2
    }

    const previousStep = () => {
      currentStep.value = 1
    }

    const onCityChange = () => {
      // Reset district when city changes
      registerForm.value.district = ''
    }

    const handleRegister = async () => {
      loading.value = true

      try {
        // Burada API çağrısı yapılacak
        console.log('Register attempt:', registerForm.value)

        // Simulated API call
        await new Promise(resolve => setTimeout(resolve, 1500))

        // Success
        emit('register-success', registerForm.value)
        closeModal()
      } catch (error) {
        console.error('Registration failed:', error)
        // Error handling burada yapılacak
      } finally {
        loading.value = false
      }
    }

    const switchToLogin = () => {
      emit('switch-to-login')
    }

    const openTerms = () => {
      console.log('Open terms and conditions')
      // Kullanım şartları modal/sayfa açma
    }

    const openPrivacy = () => {
      console.log('Open privacy policy')
      // Gizlilik politikası modal/sayfa açma
    }

    return {
      registerForm,
      currentStep,
      showPassword,
      showConfirmPassword,
      loading,
      currencyOptions,
      cityOptions,
      districtOptions,
      closeModal,
      isValidEmail,
      nextStep,
      previousStep,
      onCityChange,
      handleRegister,
      switchToLogin,
      openTerms,
      openPrivacy
    }
  }
})
</script>

<style scoped>
.register-modal {
  width: 100%;
  max-width: 520px;
  background: #1e222a;
  border-radius: 16px;
  border: 1px solid #333;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
  max-height: 90vh;
  overflow-y: auto;
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

/* Step Progress */
.step-progress {
  margin-bottom: 32px;
}

.progress-bar {
  width: 100%;
  height: 4px;
  background: #333;
  border-radius: 2px;
  margin-bottom: 16px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #00ff88 0%, #00cc6a 100%);
  transition: width 0.3s ease;
}

.step-indicators {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.step-indicator {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  opacity: 0.5;
  transition: opacity 0.3s ease;
}

.step-indicator.active {
  opacity: 1;
}

.step-indicator span {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #333;
  color: #888;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  transition: all 0.3s ease;
}

.step-indicator.active span {
  background: linear-gradient(135deg, #00ff88 0%, #00cc6a 100%);
  color: #1a1a1a;
}

.step-indicator label {
  font-size: 12px;
  color: #888;
  text-align: center;
  font-weight: 500;
}

.step-indicator.active label {
  color: #00ff88;
}

/* Step Content */
.step-content {
  min-height: 400px;
}

.register-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
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
  flex-direction: column;
  gap: 16px;
  margin-top: 8px;
}

.terms-checkbox,
.marketing-checkbox {
  color: #888;
}

.terms-text {
  font-size: 14px;
  line-height: 1.4;
}

.terms-link {
  color: #00ff88;
  text-decoration: none;
  font-weight: 500;
}

.terms-link:hover {
  color: #00cc6a;
  text-decoration: underline;
}

.form-actions {
  display: flex;
  gap: 16px;
  margin-top: 8px;
}

.next-btn,
.register-btn {
  flex: 1;
  height: 48px;
  background: linear-gradient(90deg, #00ff88 0%, #00cc6a 100%);
  color: #1a1a1a;
  font-weight: 600;
  font-size: 16px;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0, 255, 136, 0.3);
}

.next-btn:hover,
.register-btn:hover:not(:disabled) {
  box-shadow: 0 6px 20px rgba(0, 255, 136, 0.4);
}

.register-btn:disabled {
  background: #333;
  color: #666;
  box-shadow: none;
}

.back-btn {
  flex: 0 0 auto;
  color: #888;
  border: 1px solid #333;
  border-radius: 12px;
  padding: 0 24px;
}

.back-btn:hover {
  color: #fff;
  border-color: #555;
}

.modal-footer {
  padding: 0 24px 24px 24px;
}

.login-link {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  color: #888;
}

.login-btn {
  color: #00ff88;
  font-weight: 600;
  padding: 4px 8px;
}

.login-btn:hover {
  color: #00cc6a;
}

/* Mobile Responsive */
@media (max-width: 600px) {
  .register-modal {
    margin: 16px;
    max-width: calc(100vw - 32px);
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 20px;
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

  .form-actions {
    flex-direction: column;
  }

  .back-btn {
    order: 2;
  }
}

@media (max-width: 480px) {
  .terms-text {
    font-size: 13px;
  }

  .step-indicator label {
    font-size: 11px;
  }
}
</style>
