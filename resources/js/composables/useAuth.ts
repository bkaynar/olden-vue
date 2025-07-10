import { useForm, usePage } from '@inertiajs/vue3';
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
        // Inertia ile logout endpoint'ine POST isteği gönder
        const form = useForm({});

        form.post('/user/logout', {
            onError: (errors) => {
                console.error('Logout error:', errors);
                // Hata durumunda home'a yönlendir
                window.location.href = '/';
            },
        });
    };

    return {
        user,
        isAuthenticated,
        logout,
    };
}
