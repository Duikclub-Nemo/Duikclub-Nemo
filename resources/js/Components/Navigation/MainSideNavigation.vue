<script setup>
import {Link} from "@inertiajs/vue3";
import {XMarkIcon} from "@heroicons/vue/24/outline";
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from "@headlessui/vue";
import MainSideNavigationItem from "@/Components/Navigation/MainSideNavigationItem.vue";

const props = defineProps({
    navigation: Array,
    open: Boolean
})
</script>

<template>
    <TransitionRoot :show="props.open" as="aside">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <TransitionChild as="template"
                             enter="transition-opacity ease-linear duration-300"
                             enter-from="opacity-0"
                             enter-to="opacity-100"
                             leave="transition-opacity ease-linear duration-300"
                             leave-from="opacity-100"
                             leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-900/70 transition-opacity backdrop-blur-sm"/>
            </TransitionChild>
            <div class="fixed inset-0 flex">
                <TransitionChild as="template"
                                 enter="transition ease-in-out duration-300 transform"
                                 enter-from="-translate-x-full"
                                 enter-to="translate-x-0"
                                 leave="transition ease-in-out duration-300 transform"
                                 leave-from="translate-x-0"
                                 leave-to="-translate-x-full">
                    <DialogPanel class="relative mr-16 flex w-full max-w-sm flex-1" as="aside">
                        <TransitionChild as="template"
                                         enter="ease-in-out duration-300"
                                         enter-from="opacity-0"
                                         enter-to="opacity-100"
                                         leave="ease-in-out duration-300"
                                         leave-from="opacity-100"
                                         leave-to="opacity-0">
                            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                <button type="button" class="-m-2.5 p-2.5 hover:bg-gray-600 rounded-lg"
                                        @click="$emit('close')">
                                    <span class="sr-only">Sluit menu</span>
                                    <XMarkIcon class="h-6 w-6 text-white"/>
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar Component -->
                        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white pb-4 scrollbar-thin">
                            <div class="flex h-16 shrink-0 items-center px-4 bg-[url('@/Assets/images/header.jpg')] bg-cover bg-top">
                                <Link class="flex mx-auto"
                                      :href="route('home')"
                                      @click="$emit('close')">
                                    <div class="font-logo text-white drop-shadow-[2px_2px_var(--tw-shadow-color)] shadow-gray-800 mx-auto sm:mx-0">
                                        <p class="text-3xl sm:text-4xl">{{ $page.props.app.title }}</p>
                                    </div>
                                </Link>
                            </div>
                            <nav class="flex flex-1 flex-col">
                                <div role="list" class="flex flex-1 flex-col gap-y-7">
                                    <div>
                                        <ul role="list" class="space-y-1">
                                            <MainSideNavigationItem v-for="item in props.navigation"
                                                                    :key="item.name"
                                                                    :name="item.name"
                                                                    :href="item.href"
                                                                    :component="item.component"
                                                                    :submenu="item.submenu"
                                                                    @close="$emit('close')"/>
                                        </ul>
                                    </div>
                                    <div class="mt-auto">
                                        <!-- Bottom of the sidebar-->
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
