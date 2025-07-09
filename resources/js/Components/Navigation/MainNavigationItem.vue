<script setup>
import {onBeforeMount, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import {Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
import {ChevronDownIcon} from "@heroicons/vue/24/outline";

const props = defineProps({
    name: String,
    href: String,
    component: {
        type: Array,
        required: false,
        default: () => [],
    },
    submenu: {
        type: Array,
        required: false
    },
})

const allComponents = ref([...props.component])

onBeforeMount(() => {
    if (props.submenu && props.submenu.length > 0) {
        props.submenu.forEach(item => {
            allComponents.value = [...allComponents.value, ...item.component]
        })
    }
})

</script>

<template>
    <Popover v-if="props.submenu"
             class="relative flex h-full"
             v-slot="{ open }">
        <PopoverButton
            class="inline-flex items-center border-b-2 px-1 text-sm font-medium focus:outline-hidden cursor-pointer"
            :class="allComponents.includes($page.component) ? 'border-white text-white' : 'border-transparent text-gray-100 hover:border-gray-100 hover:text-gray-100'">
            {{ props.name }}
            <ChevronDownIcon class="size-4 flex-none ml-3 transform transition-transform duration-200"
                             :class="open && 'rotate-180 transform'"
                             aria-hidden="true"/>
        </PopoverButton>
        <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel v-slot="{ close }"
                          class="absolute top-full z-10 mt-1 w-screen border border-gray-100 max-w-xs overflow-hidden rounded-md bg-white shadow-lg">
                <Link v-for="item in props.submenu"
                      :key="item.name"
                      :href="item.href"
                      class="flex border-l-4 p-4 text-sm font-medium leading-6"
                      :class="item.component.includes($page.component) ? 'border-primary-500 bg-primary-50 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900'"
                      :aria-current="item.component.includes($page.component) ? 'page' : undefined"
                      @click="close">
                    {{ item.name }}
                </Link>
            </PopoverPanel>
        </transition>
    </Popover>
    <Link v-else
          :href="props.href"
          class="inline-flex h-full items-center border-b-2 px-1 text-sm font-medium"
          :class="allComponents.includes($page.component) ? 'border-white text-white' : 'border-transparent text-gray-100 hover:border-gray-100 hover:text-gray-100'"
          :aria-current="allComponents.includes($page.component) ? 'page' : undefined">
        {{ props.name }}
    </Link>
</template>
