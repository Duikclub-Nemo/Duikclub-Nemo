<script setup>
import {defineAsyncComponent, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {useToastStore} from "@/Stores/toastStore.js";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputError from "@/Components/Forms/InputError.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const props = defineProps({
    sessions: Object,
})

const toasts = useToastStore();

const confirmingLogout = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmLogout = () => {
    confirmingLogout.value = true;
    setTimeout(() => passwordInput.value.focus(), 250);
};

const logoutOtherBrowserSessions = () => {
    form.delete(route('member.setting.destroy_sessions'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            toasts.success('Je bent uitgelogd bij alle andere browsersessies.')
        },
        onError: () => {
            passwordInput.value.focus()
        },
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;
    form.reset();
};

const ConfirmationModal = defineAsyncComponent(() =>
    import('@/Modals/Modal.vue'))
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Gekoppelde apparaten
            </h2>
            <p class="mt-1 text-gray-600">
                Beheer en log uit je actieve sessies op andere browsers en apparaten. Indien noodzakelijk kun je
                jezelf op al je andere apparaten uitloggen. Hieronder zie je een paar van je recente sessies, maar het
                kan zijn dat niet alles erbij staat. Heb je het gevoel dat er iemand anders op je account zit? Pas dan
                ook even je wachtwoord aan.
            </p>
        </header>
        <div class="mt-5 space-y-6">
            <div v-for="(session, i) in props.sessions"
                 :key="i"
                 class="flex items-center">
                <div>
                    <svg v-if="session.agent.is_desktop" class="size-8 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/>
                    </svg>
                    <svg v-else class="size-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                    </svg>
                </div>
                <div class="ms-3">
                    <div class="text-gray-600">
                        {{ session.agent.platform ? session.agent.platform : 'Onbekend' }} -
                        {{ session.agent.browser ? session.agent.browser : 'Onbekend' }}
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">
                            {{ session.ip_address }},
                            <span v-if="session.is_current_device"
                                  class="text-green-500 font-semibold">Huidig apparaat</span>
                            <span v-else>Laatst actief {{ session.last_active }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center mt-5">
            <PrimaryButton @click="confirmLogout">
                Andere apparaten uitloggen
            </PrimaryButton>
        </div>
    </section>

    <ConfirmationModal :show="confirmingLogout"
                       title="Andere apparaten uitloggen"
                       @close="closeModal">
        Bevestig met je wachtwoord dat je op al je apparaten uit alle andere browsersessies wilt uitloggen.
        <div class="mt-4">
            <InputText ref="passwordInput"
                       v-model="form.password"
                       type="password"
                       class="mt-1 block w-3/4"
                       placeholder="Wachtwoord"
                       autocomplete="current-password"
                       @keyup.enter="logoutOtherBrowserSessions"/>
            <InputError :message="form.errors.password" class="mt-2"/>
        </div>
        <template #footer>
            <PrimaryButton class="w-full sm:w-auto"
                           :disabled="form.processing"
                           @click="logoutOtherBrowserSessions">
                Andere apparaten uitloggen
            </PrimaryButton>
            <SecondaryButton class="w-full sm:w-auto"
                             @click="closeModal">
                Annuleren
            </SecondaryButton>
        </template>
    </ConfirmationModal>

</template>
