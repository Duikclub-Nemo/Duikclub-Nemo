<script setup>
import {defineAsyncComponent, onMounted, ref, watch} from "vue";
import {BellIcon} from "@heroicons/vue/24/outline/index.js";
import {useAuthStore} from "@/Stores/authStore.js";
import {usePushStore} from "@/Stores/pushStore.js";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const showModal = ref(false)

const auth = useAuthStore()
const push = usePushStore()

const shouldShowModal = () => {
    showModal.value = push.shouldShowPermissionModal
}

function declinePermission() {
    push.declinePermission()
    showModal.value = false
}

function requestPermission() {
    push.requestPermission()
    showModal.value = false
}

onMounted(() => {
    shouldShowModal()
    push.initialize()
})

watch(() => auth.isLoggedIn, () => {
        shouldShowModal()
    }
)

const ShowPermissionModal = defineAsyncComponent(() =>
    import('@/Modals/Modal.vue'))
</script>

<template>
    <ShowPermissionModal :show="showModal"
                         title="Meldingen toestaan"
                         @close="showModal = false">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-primary-100 sm:mx-0 sm:size-10">
                <BellIcon class="size-6 text-primary-600" aria-hidden="true"/>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <div class="text-gray-500">
                    Wil je notificaties ontvangen over duikactiviteiten en updates? Dan zal je op dit apparaat
                    toestemming moeten geven om meldingen te ontvangen.
                </div>
            </div>
        </div>
        <template #footer>
            <PrimaryButton class="w-full sm:w-auto"
                           @click="requestPermission()">
                Toestaan
            </PrimaryButton>
            <SecondaryButton type="button"
                             class="w-full sm:w-auto"
                             @click="declinePermission()">
                Weigeren
            </SecondaryButton>
        </template>
    </ShowPermissionModal>
</template>
