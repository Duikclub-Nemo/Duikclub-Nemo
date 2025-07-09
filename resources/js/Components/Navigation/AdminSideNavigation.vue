<script setup>
import {Link} from "@inertiajs/vue3";
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {ArrowUpOnSquareIcon, Cog6ToothIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import AdminSideNavigationItem from "@/Components/Navigation/AdminSideNavigationItem.vue";

const props = defineProps({
    open: Boolean
})

const navigation = [
    {
        name: 'Overzicht',
        is: 'super-admin|admin|user',
        href: route('admin.dashboard'),
        component: ['Admin/Dashboard']
    },
    // {
    //     name: 'Nieuws',
    //     submenu: [
    //         {
    //             name: 'Nieuws',
    //             can: 'news.viewAny|news.create|news.edit|news.delete|news.restore',
    //             href: route('admin.news.index'),
    //             component: ['Admin/News/Index', 'Admin/News/Show', 'Admin/News/Edit'],
    //         },
    //         {
    //             name: 'Nieuws toevoegen',
    //             can: 'news.create',
    //             href: route('admin.news.create'),
    //             component: ['Admin/News/Create'],
    //         },
    //         {
    //             name: 'Nieuwscategorieën',
    //             can: 'news_category.viewAny|news_category.create|news_category.edit|news_category.delete|news_category.restore',
    //             href: route('admin.news_category.index'),
    //             component: ['Admin/NewsCategory/Index', 'Admin/NewsCategory/Show', 'Admin/NewsCategory/Edit'],
    //         },
    //         {
    //             name: 'Nieuwscategorie toevoegen',
    //             can: 'news_category.create',
    //             href: route('admin.news_category.create'),
    //             component: ['Admin/NewsCategory/Create'],
    //         },
    //     ]
    // },
    {
        name: 'Leden',
        submenu: [
            {
                name: 'Leden',
                can: 'user.viewAny|user.create|user.activate|user.edit|user.delete|user.restore',
                href: route('admin.user.index'),
                component: ['Admin/User/Index', 'Admin/User/Show', 'Admin/User/Edit'],
            },
            {
                name: 'Lid toevoegen',
                can: 'user.create',
                href: route('admin.user.create'),
                component: ['Admin/User/Create', 'Admin/User/Activate'],
            }
        ]
    },


]


</script>

<template>
    <TransitionRoot :show="props.open" as="aside">
        <Dialog as="div" class="relative z-40" @close="$emit('close')">
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
                                        @click="$emit('close')">
                                    <span class="sr-only">Sluit menu</span>
                                    <XMarkIcon class="h-6 w-6 text-white"/>
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar Component -->
                        <div class="flex grow flex-col gap-y-5 py-4 px-3 overflow-y-auto bg-white">
                            <div class="flex justify-center items-center text-gray-500">
                                <Cog6ToothIcon class="h-5 w-5 mr-2"/>
                                <span class="text-lg font-semibold uppercase">Beheer</span>
                            </div>
                            <hr/>
                            <nav class="flex flex-1 flex-col">
                                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                    <li>
                                        <ul role="list" class="space-y-2">
                                            <AdminSideNavigationItem v-for="item in navigation"
                                                                     :key="item.name"
                                                                     :name="item.name"
                                                                     :can="item.can"
                                                                     :is="item.is"
                                                                     :href="item.href"
                                                                     :component="item.component"
                                                                     :submenu="item.submenu"
                                                                     @close="$emit('close')"/>
                                        </ul>
                                    </li>
                                    <li class="mt-auto flex-col text-center space-y-2">
                                        <Link :href="route('logout')"
                                              method="post"
                                              class="flex w-full items-center justify-center"
                                              @click="$emit('close')">
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
