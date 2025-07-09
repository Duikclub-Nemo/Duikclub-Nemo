<script setup>
import {defineAsyncComponent, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import DangerButton from "@/Components/Forms/DangerButton.vue";
import InputText from "@/Components/Forms/InputText.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";

const confirmingDestroy = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmDestroy = () => {
    confirmingDestroy.value = true;
    setTimeout(() => passwordInput.value.focus(), 250);
};

const destroyUser = () => {
    form.delete(route('member.profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => {
            passwordInput.value.focus()
        },
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingDestroy.value = false;
    form.reset();
};

const ConfirmationModal = defineAsyncComponent(() =>
    import('@/Modals/Modal.vue'))
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Verwijder profiel
            </h2>
            <p class="mt-1 text-gray-600">
                Zodra jouw profiel is verwijderd, worden alle gegevens verwijderd. Download voordat
                je jouw profiel verwijdert alle gegevens of informatie die je wilt behouden. N.b. het verwijderen van
                jouw profiel is géén opzegging van jouw lidmaatschap.
            </p>
        </header>
        <DangerButton @click="confirmDestroy">Profiel verwijderen</DangerButton>
    </section>

    <ConfirmationModal :show="confirmingDestroy"
                       title="Weet je zeker dat je je profiel wilt verwijderen?"
                       @close="closeModal">
        Zodra je profiel is verwijderd, worden alle gegevens permanent verwijderd. Voer je
        wachtwoord in om te bevestigen dat je je profiel permanent wilt verwijderen.
        <div class="mt-4">
            <InputLabel for="password"
                        value="Wachtwoord"
                        class="sr-only"/>
            <InputText ref="passwordInput"
                       v-model="form.password"
                       type="password"
                       class="mt-1 block w-3/4"
                       placeholder="Wachtwoord"
                       autocomplete="current-password"
                       @keyup.enter="destroyUser"/>
            <InputError :message="form.errors.password" class="mt-2"/>
        </div>
        <template #footer>
            <DangerButton class="w-full sm:w-auto"
                          :disabled="form.processing"
                          @click="destroyUser">
                Verwijder profiel
            </DangerButton>
            <SecondaryButton class="w-full sm:w-auto"
                             @click="closeModal">
                Annuleren
            </SecondaryButton>
        </template>
    </ConfirmationModal>
</template>
