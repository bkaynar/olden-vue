import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import type { User } from '../types';

export function useAuth() {
    // Inertia'dan user bilgisini al
    const page = usePage();

    // User bilgisini reactive olarak takip et
    const user = computed(() => page.props.auth?.user as User | null);

    // Giriş yapılmış mı kontrolü
    const isAuthenticated = computed(() => !!user.value);

    // Çıkış fonksiyonu
    const logout = () => {
        // Form submit ile logout endpoint'ine istek gönder
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/user/logout';

        // CSRF token ekle
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = csrfToken;
            form.appendChild(tokenInput);
        }

        document.body.appendChild(form);
        form.submit();
    };

    return {
        user,
        isAuthenticated,
        logout,
    };
}
