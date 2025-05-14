<script setup>
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import {debounce} from "lodash";
import {useAuthStore} from "@/Stores/authStore.js";
import {usePushStore} from "@/Stores/pushStore.js";
import InputSwitch from "@/Components/Forms/InputSwitch.vue";
import InputText from "@/Components/Forms/InputText.vue";
import Alert from "@/Components/Layout/Alert.vue";
import {useToastStore} from "@/Stores/toastStore.js";

const props = defineProps({
    user: Object,
});

const auth = useAuthStore();
const push = usePushStore();
const toasts = useToastStore();

const params = ref({
    notify_push_admin: props.user.notify_push_admin ?? false,
    notify_mail_admin: props.user.notify_mail_admin,
    notify_push_news_added: props.user.notify_push_news_added,
    notify_mail_news_added: props.user.notify_mail_news_added,
    notify_push_news_edited: props.user.notify_push_news_edited,
    notify_mail_news_edited: props.user.notify_mail_news_edited,
    notify_push_activity_added: props.user.notify_push_activity_added,
    notify_mail_activity_added: props.user.notify_mail_activity_added,
    notify_push_activity_edited: props.user.notify_push_activity_edited,
    notify_mail_activity_edited: props.user.notify_mail_activity_edited,
    notify_push_activity_removed: props.user.notify_push_activity_removed,
    notify_mail_activity_removed: props.user.notify_mail_activity_removed,
    notify_push_subscription_added: props.user.notify_push_subscription_added,
    notify_mail_subscription_added: props.user.notify_mail_subscription_added,
    notify_push_subscription_edited: props.user.notify_push_subscription_edited,
    notify_mail_subscription_edited: props.user.notify_mail_subscription_edited,
    notify_push_subscription_removed: props.user.notify_push_subscription_removed,
    notify_mail_subscription_removed: props.user.notify_mail_subscription_removed,
    notify_push_activity_reminder: props.user.notify_push_activity_reminder,
    notify_mail_activity_reminder: props.user.notify_mail_activity_reminder,
    notify_push_activity_reminder_minutes_before: props.user.notify_push_activity_reminder_minutes_before,
    notify_mail_activity_reminder_minutes_before: props.user.notify_mail_activity_reminder_minutes_before
})

watch(params, debounce(function (queryParams) {
    router.patch(route('member.setting.update_notifications'), queryParams, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
        onSuccess: () => toasts.success('Jouw instellingen zijn bijgewerkt.'),
        onError: () => toasts.danger('Er is iets misgegaan.')
    });
}, 300), {deep: true});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Notificaties
            </h2>
            <p class="mt-1 text-gray-600">
                Kies hier hoe je op de hoogte wilt blijven van nieuwe activiteiten, berichten en updates vanuit de club.
            </p>
        </header>
        <div class="mt-6 space-y-6 overflow-x-auto">
            <Alert v-if="!push.hasPermission"
                   type="warning">
                Je hebt op dit apparaat geen toestemming gegeven om Push-notificaties te ontvangen.
            </Alert>
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <tbody>
                <template v-if="auth.hasRole('super-admin|admin')">
                    <tr class="bg-gray-50">
                        <th class="px-1 py-2 text-left text-sm font-medium text-gray-700">Beheer</th>
                        <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">Push</th>
                        <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">E-mail</th>
                    </tr>
                    <tr>
                        <td class="px-1 py-2 whitespace-nowrap text-gray-800">Beheerdersberichten</td>
                        <td class="px-1 py-2">
                            <div class="flex justify-center">
                                <InputSwitch v-model="params.notify_push_admin"/>
                            </div>
                        </td>
                        <td class="px-1 py-2">
                            <div class="flex justify-center">
                                <InputSwitch v-model="params.notify_mail_admin"/>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr class="bg-gray-50">
                    <th class="px-1 py-2 text-left text-sm font-medium text-gray-700">Nieuws</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">Push</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">E-mail</th>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Nieuws toegevoegd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_news_added"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_news_added"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Nieuws gewijzigd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_news_edited"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_news_edited"/>
                        </div>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <th class="px-1 py-2 text-left text-sm font-medium text-gray-700">Activiteiten</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">Push</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">E-mail</th>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Activiteit toegevoegd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_activity_added"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_activity_added"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Activiteit gewijzigd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_activity_edited"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_activity_edited"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Activiteit geannuleerd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_activity_removed"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_activity_removed"/>
                        </div>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <th class="px-1 py-2 text-left text-sm font-medium text-gray-700">Herinnering</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">Push</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">E-mail</th>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Activiteit herinnering</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_activity_reminder"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_activity_reminder"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Minuten vóór herinnering</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputText v-model="params.notify_push_activity_reminder_minutes_before"
                                       type="number"
                                       class="min-w-18 max-w-22 text-center"
                                       min="0"
                                       :disabled="!params.notify_push_activity_reminder"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputText v-model="params.notify_mail_activity_reminder_minutes_before"
                                       type="number"
                                       class="min-w-18 max-w-22 text-center"
                                       min="0"
                                       :disabled="!params.notify_mail_activity_reminder"/>
                        </div>
                    </td>
                </tr>
                <tr class="bg-gray-50">
                    <th class="px-1 py-2 text-left text-sm font-medium text-gray-700">Aanmeldingen</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">Push</th>
                    <th class="px-1 py-2 text-center text-sm font-medium text-gray-700">E-mail</th>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Aanmelding toegevoegd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_subscription_added"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_subscription_added"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Aanmelding gewijzigd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_subscription_edited"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_subscription_edited"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-2 whitespace-nowrap text-gray-800">Aanmelding geannuleerd</td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_push_subscription_removed"/>
                        </div>
                    </td>
                    <td class="px-1 py-2">
                        <div class="flex justify-center">
                            <InputSwitch v-model="params.notify_mail_subscription_removed"/>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
