<script setup>
import {onBeforeMount, ref} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import {Disclosure, DisclosureButton, DisclosurePanel, TransitionRoot} from "@headlessui/vue";
import {ChevronDownIcon} from "@heroicons/vue/24/outline";

const page = usePage()
const openDropmenu = ref(false)

const props = defineProps({
    name: String,
    href: String,
    component: {
        type: Array,
        required: false,
        default: () => []
    },
    submenu: {
        type: Array,
        required: false,
    }
})

const allComponents = ref([...props.component])

function changeOpenState(open) {
    if (page.component.startsWith(props.component) && !open) {
        openDropmenu.value = false
    } else if (page.component.startsWith(props.component) && open) {
        openDropmenu.value = true
    } else openDropmenu.value = !open;
}

onBeforeMount(() => {
    if (props.submenu && props.submenu.length > 0) {
        props.submenu.forEach(item => {
            allComponents.value = [...allComponents.value, ...item.component]
        })
    }
    openDropmenu.value = allComponents.value.includes(page.component)
})
</script>

<template>
    <li v-if="props.submenu">
        <Disclosure as="div" v-slot="{ open }">
            <DisclosureButton @click="changeOpenState(!open)"
                              class="flex w-full items-center justify-between px-3 py-2 text-base leading-7 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900 cursor-pointer">
                {{ props.name }}
                <ChevronDownIcon
                    class="size-5 flex-none transform transition-transform duration-200"
                    :class="openDropmenu && 'rotate-180 transform'"
                    aria-hidden="true"/>
            </DisclosureButton>
            <TransitionRoot
                :show="openDropmenu"
                enter="transition ease-out duration-200"
                enter-from="opacity-0 translate-y-1"
                enter-to="opacity-100 translate-y-0"
                leave="transition ease-in duration-150"
                leave-from="opacity-100 translate-y-0"
                leave-to="opacity-0 translate-y-1">
                <DisclosurePanel static
                                 as="ul"
                                 class="mt-2 space-y-2">
                    <li v-for="item in props.submenu"
                        :key="item.name">
                        <DisclosureButton
                            :as="Link"
                            :href="item.href"
                            class="flex w-full items-center py-2 pl-6 pr-3 text-base leading-7 border-l-4"
                            :class="item.component.includes($page.component) ? 'border-primary-500 bg-primary-50 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-300  hover:bg-gray-50 hover:text-gray-900'"
                            :aria-current="item.component.includes($page.component) ? 'page' : undefined"
                            @click="$emit('close')">
                            {{ item.name }}
                        </DisclosureButton>
                    </li>
                </DisclosurePanel>
            </TransitionRoot>
        </Disclosure>
    </li>
    <li v-else>
        <Link :href="props.href"
              class="flex w-full items-center px-3 py-2 text-base leading-7 border-l-4"
              :class="allComponents.includes($page.component) ? 'border-primary-500 bg-primary-50 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900'"
              :aria-current="allComponents.includes($page.component) ? 'page' : undefined"
              @click="$emit('close')">
            {{ props.name }}
        </Link>
    </li>
</template>
