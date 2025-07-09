<script setup>
import {ref, watch} from "vue";
import InputSwitch from "@/Components/Forms/InputSwitch.vue";
import {debounce} from "lodash";
import {router} from "@inertiajs/vue3";
import {useToastStore} from "@/Stores/toastStore.js";

const props = defineProps({
    user: Object,
})

const toasts = useToastStore();

const params = ref({
    privacy_mode: props.user.privacy_mode,
    display_userlist: props.user.display_userlist
})

watch(params, debounce(function (queryParams) {
    router.patch(route('member.setting.update'), queryParams, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: () => toasts.success('Jouw instellingen zijn bijgewerkt.'),
        onError: () => toasts.danger('Er is iets misgegaan.')
    });
}, 300), {deep: true});
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Instellingen
            </h2>
            <p class="mt-1 text-gray-600">
                Hier kun je de belangrijkste instellingen aanpassen.
            </p>
        </header>
        <ul role="list" class="mt-6 divide-y divide-gray-200">
            <li class="flex items-center justify-between pb-4 space-x-4">
                <div class="flex flex-col">
                    <p class="font-medium text-gray-900">
                        Privacy Mode
                    </p>
                    <p class="text-gray-500">
                        Als je de Privacy Mode inschakelt, wordt alleen je voornaam getoond aan gasten. Dit geldt voor nieuwsberichten en activiteiten die publiek zichtbaar zijn.
                    </p>
                </div>
                <InputSwitch v-model="params.privacy_mode"/>
            </li>
            <li class="flex items-center justify-between py-4 space-x-4">
                <div class="flex flex-col">
                    <p class="font-medium text-gray-900">
                        Weergeven op ledenlijst
                    </p>
                    <p class="text-gray-500">
                        Als lid kun je ervoor kiezen om niet zichtbaar te zijn op de ledenlijst. Deze is alleen toegankelijk voor geregistreerde leden.
                    </p>
                </div>
                <InputSwitch v-model="params.display_userlist"/>
            </li>
        </ul>
    </section>
</template>
