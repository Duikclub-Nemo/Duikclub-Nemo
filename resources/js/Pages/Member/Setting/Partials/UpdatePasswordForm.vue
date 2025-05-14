<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {useToastStore} from "@/Stores/toastStore.js";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputError from "@/Components/Forms/InputError.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const toasts = useToastStore();
const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            toasts.success('Wachtwoord succesvol bijgewerkt.');
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Update wachtwoord
            </h2>
            <p class="mt-1 text-gray-600">
                Zorg ervoor dat je account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.
            </p>
        </header>
        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" value="Huidig wachtwoord"/>
                <InputText id="current_password"
                           ref="currentPasswordInput"
                           v-model="form.current_password"
                           type="password"
                           class="block w-full"
                           autocomplete="current-password"
                           :disabled="form.processing"/>
                <InputError :message="form.errors.current_password"
                            class="mt-2"/>
            </div>
            <div>
                <InputLabel for="password" value="Nieuw wachtwoord"/>
                <InputText id="password"
                           ref="passwordInput"
                           v-model="form.password"
                           type="password"
                           class="block w-full"
                           autocomplete="new-password"
                           :disabled="form.processing"/>
                <InputError :message="form.errors.password" class="mt-2"/>
            </div>
            <div>
                <InputLabel for="password_confirmation"
                            value="Bevestig wachtwoord"/>
                <InputText id="password_confirmation"
                           v-model="form.password_confirmation"
                           type="password"
                           class="block w-full"
                           autocomplete="new-password"
                           :disabled="form.processing"/>
                <InputError :message="form.errors.password_confirmation"
                            class="mt-2"/>
            </div>
            <PrimaryButton type="submit"
                           :disabled="form.processing">
                Opslaan
            </PrimaryButton>
        </form>
    </section>
</template>
