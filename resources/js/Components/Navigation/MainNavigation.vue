<script setup>
import {defineAsyncComponent, onMounted, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import {PopoverGroup} from "@headlessui/vue";
import {Bars3BottomLeftIcon} from "@heroicons/vue/24/solid";
import {useAuthStore} from "@/Stores/authStore";
import Container from "@/Components/Layout/Container.vue";
import MainNavigationItem from "@/Components/Navigation/MainNavigationItem.vue";
import MainSideNavigation from "@/Components/Navigation/MainSideNavigation.vue";
import UserNavigation from "@/Components/Navigation/UserNavigation.vue";
import AccentButton from "@/Components/Forms/AccentButton.vue";

const props = defineProps({
    headerHeight: {
        type: String,
        default: 1,
    },
})

const auth = useAuthStore()
const scrollPosition = ref(0)
const showMainMenu = ref(false)
const showUserMenu = ref(false)
const showAdminMenu = ref(false)

const navigation = [
    {
        name: 'Nieuws',
        href: route('news.index'),
        component: ['News/Index']
    },
    {
        name: 'Duikclub Nemo',
        submenu: [
            {
                name: 'Over Duikclub Nemo',
                href: route('about.about'),
                component: ['About/About']
            },
            {
                name: 'Lidmaatschap & Contributie',
                href: route('about.membership'),
                component: ['About/Membership']
            },
            {
                name: 'Les- en trainingslocatie',
                href: route('about.location'),
                component: ['About/Location']
            },
            {
                name: 'Nederlandse Onderwatersport Bond',
                href: route('about.federation'),
                component: ['About/Federation']
            },
            {
                name: 'Proefles',
                href: route('about.trail'),
                component: ['About/Trail']
            }
        ]
    },
    {
        name: 'Agenda',
        href: route('activities.index'),
        component: ['Activities/Index']
    },
    {
        name: 'Opleidingen',
        submenu: [
            {
                name: 'Duikopleidingen',
                href: route('certification.index'),
                component: ['Certification/Index']
            },
            {
                name: 'Specialisaties vanaf het 1*-brevet',
                href: route('certification.specialties1'),
                component: ['Certification/Specialties_1']
            },
            {
                name: 'Specialisaties vanaf het 2*-brevet',
                href: route('certification.specialties2'),
                component: ['Certification/Specialties_2']
            },
            {
                name: 'Specialisaties vanaf het 3*-brevet',
                href: route('certification.specialties3'),
                component: ['Certification/Specialties_3']
            },
            {
                name: 'PvB Eigen Vaardigheden',
                href: route('certification.skills'),
                component: ['Certification/Skills']
            },
            {
                name: 'Reanimatie',
                href: route('certification.cpr'),
                component: ['Certification/Cpr']
            },
        ]
    },
    {
        name: 'Foto\'s & Video\'s',
        href: route('gallery.index'),
        component: ['Gallery/Index']
    },
    {
        name: 'Over duiken',
        href: route('blog.index'),
        component: ['Blog/Index']
    },
    {
        name: 'Contact',
        href: route('contact.create'),
        component: ['Contact']
    },
]

function updateScroll() {
    scrollPosition.value = window.scrollY
}

onMounted(() => {
    window.addEventListener('scroll', updateScroll)
})

const UserSideNavigation = defineAsyncComponent(() =>
    import('@/Components/Navigation/UserSideNavigation.vue'))

const AdminSideNavigation = defineAsyncComponent(() =>
    import('@/Components/Navigation/AdminSideNavigation.vue'))

</script>

<template>
    <!-- Navigation Bar -->
    <PopoverGroup as="nav"
                  class="sticky z-10 top-0 right-0 bg-gradient-to-b from-primary-600 to-primary-700 transition duration-500 ease-in-out"
                  :class="[scrollPosition >= props.headerHeight ? 'shadow-md shadow-gray-500' : 'shadow-xs shadow-gray-500']"
                  aria-label="Global">
        <Container class="flex justify-between h-14 gap-x-4">
            <!-- MainMenu -->
            <div class="hidden lg:flex lg:flex-1 lg:gap-x-6 items-center">
                <MainNavigationItem v-for="item in navigation"
                                    :key="item.name"
                                    :name="item.name"
                                    :href="item.href"
                                    :component="item.component"
                                    :submenu="item.submenu"/>
            </div>
            <!-- MainSideMenuButton -->
            <div class="flex items-center lg:hidden">
                <button type="button"
                        class="p-1.5 text-gray-100 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:ring-2 focus:ring-gray-100"
                        @click="showMainMenu = !showMainMenu">
                    <span class="sr-only">Menu openen</span>
                    <Bars3BottomLeftIcon class="w-7 h-7"/>
                </button>
            </div>
            <!-- UserMenu -->
            <div class="flex items-center justify-end">
                <UserNavigation v-if="auth.isLoggedIn"
                                @open-user="showUserMenu = !showUserMenu"
                                @open-admin="showAdminMenu = !showAdminMenu"/>
                <Link v-else :href="route('login')">
                    <AccentButton>
                        Leden
                    </AccentButton>
                </Link>
            </div>
        </Container>
    </PopoverGroup>

    <!-- MobileMenu -->
    <MainSideNavigation :navigation="navigation"
                        :open="showMainMenu"
                        @close="showMainMenu = !showMainMenu"/>

    <!-- UserMenu -->
    <UserSideNavigation v-if="auth.isLoggedIn"
                        :open="showUserMenu"
                        @close="showUserMenu = !showUserMenu"/>

    <!-- AdminMenu -->
    <AdminSideNavigation v-if="auth.isLoggedIn"
                         :open="showAdminMenu"
                         @close="showAdminMenu = !showAdminMenu"/>

</template>

