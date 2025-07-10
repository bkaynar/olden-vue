<template>
    <div class="bottom-navigation" v-if="screen.lt.md">
        <div class="nav-items">
            <div v-for="item in navItems" :key="item.name" :class="['nav-item', { active: item.active }]"
                @click="selectNavItem(item)">
                <q-icon :name="item.icon" :color="item.active ? 'green' : 'grey-5'" size="24px" />
                <span :class="['nav-label', { active: item.active }]">
                    {{ item.label }}
                </span>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useQuasar } from 'quasar'

interface NavItem {
    name: string
    label: string
    icon: string
    active: boolean
}

export default defineComponent({
    name: 'BottomNavigation',

    emits: ['toggle-sidebar'],

    setup(_, { emit }) {
        const $q = useQuasar()

        const navItems = ref<NavItem[]>([
            {
                name: 'home',
                label: 'Ana Sayfa',
                icon: 'home',
                active: true
            },
            {
                name: 'sports',
                label: 'Spor',
                icon: 'sports_soccer',
                active: false
            },
            {
                name: 'live',
                label: 'Canlı',
                icon: 'live_tv',
                active: false
            },
            {
                name: 'casino',
                label: 'Casino',
                icon: 'casino',
                active: false
            },
            {
                name: 'menu',
                label: 'Menü',
                icon: 'menu',
                active: false
            }
        ])

        const selectNavItem = (item: NavItem) => {
            if (item.name === 'menu') {
                // Sidebar'ı toggle et
                emit('toggle-sidebar')
                return
            }

            navItems.value.forEach(navItem => {
                navItem.active = navItem.name === item.name
            })
        }

        return {
            screen: $q.screen,
            navItems,
            selectNavItem
        }
    }
})
</script>

<style scoped>
.bottom-navigation {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 2001;
    background: #20242e;
    border-top: 1px solid #333;
    box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.nav-items {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 8px 0;
    max-width: 100%;
}

.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 8px 12px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 60px;
    position: relative;
}

.nav-item:active {
    transform: scale(0.95);
}

.nav-item.active {
    background: rgba(0, 255, 136, 0.1);
}

.nav-item.active::before {
    content: '';
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 32px;
    height: 3px;
    background: #00ff88;
    border-radius: 2px;
}

.nav-label {
    font-size: 11px;
    font-weight: 500;
    color: #888;
    transition: color 0.3s ease;
    text-align: center;
    line-height: 1.2;
}

.nav-label.active {
    color: #00ff88;
    font-weight: 600;
}

/* iPhone X ve sonrası için safe area desteği */
@supports (padding-bottom: env(safe-area-inset-bottom)) {
    .bottom-navigation {
        padding-bottom: calc(8px + env(safe-area-inset-bottom));
    }
}

/* Çok küçük ekranlar için */
@media (max-width: 360px) {
    .nav-item {
        padding: 6px 8px;
        min-width: 50px;
    }

    .nav-label {
        font-size: 10px;
    }
}
</style>
