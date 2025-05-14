<script setup>
import {onMounted} from "vue";
import {Link} from "@inertiajs/vue3";
import {formatDistanceToNow} from "date-fns";
import {nl} from "date-fns/locale";
import {Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {BellAlertIcon, BellIcon, EyeIcon, TrashIcon} from "@heroicons/vue/24/outline/index.js";
import Badge from "@/Components/Layout/Badge.vue";
import {useNotificationStore} from "@/Stores/notificationStore.js";

const store = useNotificationStore()

onMounted(() => {
    store.fetch()
})
</script>

<template>
    <Popover class="sm:relative">
        <PopoverButton
            class="relative p-2 text-gray-100 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:ring-2 focus:ring-gray-100">
            <BellAlertIcon v-if="store.unread > 0"
                           class="size-6 wiggle"/>
            <BellIcon v-else
                      class="size-6"/>
            <!-- Badge -->
            <Badge v-if="store.unread > 0"
                   class="absolute -top-0.5 -right-0.5"
                   textSize="xs"
                   color="white">
                {{ store.unread > 99 ? '99+' : store.unread }}
            </Badge>
        </PopoverButton>
        <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel v-slot="{ close }"
                          class="absolute right-0 z-5 mt-3 w-full sm:w-120 origin-top-right">
                <div
                    class="mx-1 sm:mx-0 divide-y divide-gray-300 rounded-lg bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden">
                    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
                        Berichten
                    </div>
                    <div v-if="store.notifications.length > 0">
                        <ul class="divide-y divide-gray-100 max-h-80 overflow-y-auto scrollbar-thin">
                            <li v-for="notification in store.notifications"
                                class="relative flex px-4 py-3 hover:bg-gray-100"
                                :class="{'font-semibold' : !notification.read_at}">
                                <TrashIcon
                                    class="size-6.5 absolute top-2 right-2 p-1 cursor-pointer hover:bg-gray-200 rounded-sm"
                                    @click="store.remove(notification.id)">
                                </TrashIcon>
                                <Link :href="notification.data.url"
                                      class="w-full"
                                      @click="() => { store.markAsRead(notification.id); close()}">
                                    <div class="text-gray-500 font-semibold text-sm mb-1.5">
                                        {{ notification.data.title }}
                                    </div>
                                    <div class="text-gray-500 text-sm mb-1.5">
                                        {{ notification.data.message }}
                                    </div>
                                    <div class="text-xs text-blue-600">
                                        {{
                                            formatDistanceToNow(notification.created_at, {
                                                addSuffix: true,
                                                locale: nl
                                            })
                                        }}
                                    </div>
                                </Link>
                            </li>
                        </ul>
                        <button @click="() => { store.markAllRead()}"
                                class="inline-flex items-center justify-center w-full py-4 text-sm font-medium text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 cursor-pointer">
                            <EyeIcon class="size-4 me-2"/>
                            Alles als gelezen markeren
                        </button>
                    </div>
                    <div v-else
                         class="px-4 py-4 text-sm text-center italic">
                        Er zijn geen berichten
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<style scoped>
@keyframes wiggle {
    0%, 100% {
        transform: rotate(-10deg);
    }
    50% {
        transform: rotate(10deg);
    }
}

.wiggle {
    animation: wiggle 0.5s ease-in-out infinite;
}
</style>
