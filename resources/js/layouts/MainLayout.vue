<template>
    <q-layout view="lHh Lpr lFf">
        <AppHeader />
        <Sidebar />
        <q-page-container>
            <router-view />
        </q-page-container>
    </q-layout>
</template>

<script>
import AppHeader from '../components/Header.vue'
import Sidebar from '../components/Sidebar.vue'

export default {
    components: {
        AppHeader,
        Sidebar
    }
}
</script>
