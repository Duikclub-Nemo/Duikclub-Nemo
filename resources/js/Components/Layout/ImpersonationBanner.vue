<script setup>
import {computed} from 'vue'
import {router, usePage} from '@inertiajs/vue3'

const page = usePage()

const isImpersonating = computed(() => !!page.props.impersonation?.active)
const userName = computed(() => page.props.impersonation?.as || '')

function leaveImpersonation() {
    router.post(route('admin.impersonate.logout'), {}, {
        preserveScroll: true,
        onFinish: () => {
            isImpersonating.value = false
        },
    })
}
</script>

<template>
    <div v-if="isImpersonating"
         class="bg-red-600 text-white py-2 px-4 flex justify-between items-center shadow-md z-50 fixed bottom-0 left-0 right-0">
        <div class="text-sm">
            🔐 Je bent momenteel ingelogd als <strong>{{ userName }}</strong>
        </div>
        <button @click="leaveImpersonation"
                class="bg-white text-red-600 text-sm font-semibold px-3 py-1 rounded hover:bg-red-100 transition">
            Terug naar eigen account
        </button>
    </div>
</template>
