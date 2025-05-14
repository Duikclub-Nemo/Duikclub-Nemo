<script setup>
import {useAuthStore} from "@/Stores/authStore.js";
import {Cog6ToothIcon} from "@heroicons/vue/24/outline";
import Avatar from "@/Components/Layout/Avatar.vue";
import NotificationBell from "@/Components/Layout/NotificationBell.vue";

const auth = useAuthStore()

const emit = defineEmits(['openAdmin', 'openUser']);
</script>

<template>
    <div class="flex space-x-3">
        <!-- Notifications -->
        <NotificationBell/>
        <!-- Admin -->
        <button v-if="auth.hasRole('super-admin|admin|instructor')"
                type="button"
                class="p-2 text-gray-100 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:ring-2 focus:ring-gray-100"
                @click="emit('openAdmin')">
            <span class="sr-only">Adminmenu</span>
            <Cog6ToothIcon class="size-6"/>
        </button>
        <!-- User -->
        <button type="button"
                class="flex p-1 text-gray-100 rounded-lg cursor-pointer hover:text-white hover:bg-gray-100 focus:ring-2 focus:ring-gray-100"
                @click="emit('openUser')">
            <span class="sr-only">Gebruikersmenu</span>
            <Avatar class="size-8"
                    :url="auth.user.avatar"
                    alt=""/>
        </button>
    </div>
</template>
