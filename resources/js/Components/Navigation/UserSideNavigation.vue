<script setup>
import {Link} from "@inertiajs/vue3";
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {
    AcademicCapIcon,
    AdjustmentsVerticalIcon,
    ArrowDownTrayIcon,
    ArrowUpOnSquareIcon,
    CalendarDaysIcon,
    ClipboardDocumentCheckIcon,
    HomeIcon,
    UserIcon,
    UsersIcon,
    XMarkIcon
} from "@heroicons/vue/24/outline";
import {useAuthStore} from "@/Stores/authStore";
import UserSideNavigationItem from "@/Components/Navigation/UserSideNavigationItem.vue";
import Avatar from "@/Components/Layout/Avatar.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const props = defineProps({
    open: Boolean,
})

const auth = useAuthStore()

const emit = defineEmits(['close']);

const navigation = [
    {
        icon: HomeIcon,
        name: 'Overzicht',
        is: 'super-admin|admin|instructor|user',
        href: route('member.dashboard'),
        component: ['Member/Dashboard']
    },
    {
        icon: UserIcon,
        name: 'Mijn Profiel',
        can: 'profile.view|profile.edit|profile.delete',
        href: route('member.profile.show'),
        component: ['Member/Profile/Show', 'Member/Profile/Edit']
    },
    {
        icon: AcademicCapIcon,
        name: 'Mijn Brevetten',
        can: 'member.certificate.list|member.certificate.view|member.certificate.create|member.certificate.edit|member.certificate.delete',
        href: route('member.certificate.index'),
        component: ['Member/Certificate/Index', 'Member/Certificate/Show', 'Member/Certificate/Create', 'Member/Certificate/Edit']
    },
    {
        icon: UsersIcon,
        name: 'Ledenlijst',
        can: 'member.user.list|member.user.view',
        href: route('member.user.index'),
        component: ['Member/User/Index', 'Member/User/Show']
    },
    {
        icon: CalendarDaysIcon,
        name: 'Mijn Activiteiten',
        can: 'member.activity.list|member.activity.view|member.activity.create|member.activity.edit|member.activity.delete',
        href: route('member.activity.show'),
        component: ['Member/Activities']
    },
    {
        icon: ClipboardDocumentCheckIcon,
        name: 'Mijn Aanmeldingen',
        can: 'member.subscription.list|member.subscription.view|member.subscription.create|member.subscription.edit|member.subscription.delete',
        href: route('member.subscription.show'),
        component: ['Member/Subscriptions']
    },
    {
        icon: ArrowDownTrayIcon,
        name: 'Downloads',
        can: 'member.download.list|member.download.edit',
        href: route('member.download.show'),
        component: ['Member/Downloads']
    },
    {
        icon: AdjustmentsVerticalIcon,
        name: 'Mijn Instellingen',
        can: 'member.setting.list|member.setting.edit|profile.delete',
        href: route('member.setting.edit'),
        component: ['Member/Setting/Edit']
    },
]
</script>

<template>
    <TransitionRoot :show="props.open" as="aside">
        <Dialog as="div" class="relative z-40" @close="emit('close')">
            <TransitionChild as="template"
                             enter="transition-opacity ease-out duration-300"
                             enter-from="opacity-0"
                             enter-to="opacity-100"
                             leave="transition-opacity ease-in duration-200"
                             leave-from="opacity-100"
                             leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-900/70 transition-opacity backdrop-blur-sm"/>
            </TransitionChild>
            <div class="fixed inset-0 flex justify-end">
                <TransitionChild as="template"
                                 enter="transition ease-in-out duration-300 transform"
                                 enter-from="translate-x-full"
                                 enter-to="translate-x-0"
                                 leave="transition ease-in-out duration-300 transform"
                                 leave-from="translate-x-0"
                                 leave-to="translate-x-full">
                    <DialogPanel class="relative ml-16 flex w-full max-w-xs flex-1" as="aside">
                        <TransitionChild as="template"
                                         enter="ease-in-out duration-300"
                                         enter-from="opacity-0"
                                         enter-to="opacity-100"
                                         leave="ease-in-out duration-300"
                                         leave-from="opacity-100"
                                         leave-to="opacity-0">
                            <div class="absolute right-full top-0 flex w-16 justify-center py-5">
                                <button type="button" class="-m-2.5 p-2.5 hover:bg-gray-600 rounded-lg"
                                        @click="emit('close')">
                                    <span class="sr-only">Sluit menu</span>
                                    <XMarkIcon class="h-6 w-6 text-white"/>
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar Component -->
                        <div class="flex grow flex-col gap-y-5 py-4 px-3 overflow-y-auto bg-white">
                            <div class="flex flex-col justify-center items-center text-gray-500">
                                <Avatar class="size-32"
                                        :url="auth.user.avatar"
                                        :alt="auth.user.fullname"/>
                                <h3 class="mt-4 text-xl font-semibold tracking-tight text-gray-900">
                                    <Link href="#">{{ auth.user.fullname }}</Link>
                                </h3>
                                <div class="font-light text-gray-500">
                                    {{ auth.user.certificate }}
                                </div>
                                <div class="font-light text-gray-500">
                                    {{ auth.user.role }}
                                </div>
                                <ul class="flex justify-center mt-3 space-x-1">
                                    <li v-if="auth.hasRole('super-admin')">
                                        <a href="#"
                                           class="inline-flex text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm p-2.5">
                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr/>
                            <nav class="flex flex-1 flex-col">
                                <ul role="list" class="flex flex-1 flex-col">
                                    <li class="mb-4">
                                        <ul role="list" class="space-y-1">
                                            <UserSideNavigationItem v-for="item in navigation"
                                                                    :key="item.name"
                                                                    :icon="item.icon"
                                                                    :name="item.name"
                                                                    :href="item.href"
                                                                    :component="item.component"
                                                                    :can="item.can"
                                                                    :is="item.is"
                                                                    @close="emit('close')"/>
                                        </ul>
                                    </li>
                                    <li class="mt-auto flex-col text-center text-red-500 space-y-2">
                                        <Link :href="route('logout')"
                                              method="post"
                                              class="flex w-full items-center justify-center"
                                              @click="emit('close')">
                                            <SecondaryButton class="w-full">
                                                <ArrowUpOnSquareIcon class="mr-1 w-6 h-6 rotate-90"/>
                                                Afmelden
                                            </SecondaryButton>
                                        </Link>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
