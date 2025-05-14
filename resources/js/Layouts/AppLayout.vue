<script setup>
import {computed} from "vue";
import {useAuthStore} from "@/Stores/authStore";
import {storeToRefs} from "pinia";
import Header from "@/Components/Layout/Header.vue";
import MainNavigation from "@/Components/Navigation/MainNavigation.vue";
import Container from "@/Components/Layout/Container.vue";
import Toasts from "@/Components/Layout/Toasts.vue";
import Footer from "@/Components/Layout/Footer.vue";
import PushNotifications from "@/Components/Layout/PushNotifications.vue";
import ImpersonationBanner from "@/Components/Layout/ImpersonationBanner.vue";

const auth = useAuthStore()
const {isLoggedIn} = storeToRefs(auth)

const headerHeight = computed(() => !isLoggedIn ? '112' : '1');
</script>

<template>
    <div class="flex flex-col min-h-dvh">
        <Header v-if="!isLoggedIn"/>
        <MainNavigation :header-height="headerHeight"/>
        <main class="flex-grow">
            <Container class="py-4">
                <Toasts/>
                <slot/>
                <div v-if="auth.hasRole('super-admin')"
                     class="text-xs mt-1">
                    component: {{ $page.component }} | url: {{ $page.url }}
                </div>
            </Container>
        </main>
        <Footer/>
        <PushNotifications/>
        <ImpersonationBanner/>
    </div>
</template>
