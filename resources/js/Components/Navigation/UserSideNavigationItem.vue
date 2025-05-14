<script setup>
import {Link} from "@inertiajs/vue3";
import {useAuthStore} from "@/Stores/authStore.js";

const props = defineProps({
    icon: {
        type: Function,
        required: false,
    },
    name: String,
    href: String,
    can: {
        type: String,
        required: false
    },
    is: {
        type: String,
        required: false
    },
    component: {
        type: Array,
        required: false,
        default: () => [],
    },
})

const auth = useAuthStore()
</script>

<template>
    <li v-if="auth.hasPermission(props.can) || auth.hasRole(props.is)">
        <Link :href="props.href"
              class="flex w-full items-center px-4 py-2 text-base leading-7 rounded-xl"
              :class="props.component.includes($page.component) ? 'border-primary-500 bg-primary-50 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900'"
              :aria-current="props.component.includes($page.component) ? 'page' : undefined"
              @click="$emit('close')">
            <component v-if="icon"
                       :is="icon"
                       class="size-5 mr-3"/>
            {{ props.name }}
        </Link>
    </li>
</template>
