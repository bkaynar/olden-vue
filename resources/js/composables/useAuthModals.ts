import { ref } from 'vue';

export function useAuthModals() {
    const showLoginModal = ref(false);
    const showRegisterModal = ref(false);

    const openLoginModal = () => {
        showRegisterModal.value = false;
        showLoginModal.value = true;
    };

    const openRegisterModal = () => {
        showLoginModal.value = false;
        showRegisterModal.value = true;
    };

    const closeModals = () => {
        showLoginModal.value = false;
        showRegisterModal.value = false;
    };

    const switchToRegister = () => {
        showLoginModal.value = false;
        showRegisterModal.value = true;
    };

    const switchToLogin = () => {
        showRegisterModal.value = false;
        showLoginModal.value = true;
    };

    const handleLoginSuccess = (userData: any) => {
        console.log('Login successful:', userData);
        closeModals();
        // Burada user store'a kaydet, redirect yap vs.
    };

    const handleRegisterSuccess = (userData: any) => {
        console.log('Registration successful:', userData);
        closeModals();
        // Burada user store'a kaydet, welcome mesajı göster vs.
    };

    return {
        showLoginModal,
        showRegisterModal,
        openLoginModal,
        openRegisterModal,
        closeModals,
        switchToRegister,
        switchToLogin,
        handleLoginSuccess,
        handleRegisterSuccess,
    };
}
