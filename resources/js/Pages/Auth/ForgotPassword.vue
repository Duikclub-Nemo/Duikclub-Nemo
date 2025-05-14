<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputText from "@/Components/Forms/InputText.vue";
import Card from "@/Components/Layout/Card.vue";
import Alert from "@/Components/Layout/Alert.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
    status: String,
    canResetPassword: Boolean,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'), {
        onFinish: () => form.reset('email'),
    });
};
</script>

<template>
    <Head title="Wachtwoord vergeten?"/>
    <PageHeading title="Wachtwoord vergeten?">
        Je wachtwoord vergeten? Geen probleem. Laat ons je e-mailadres weten en we sturen je een link waarmee je je
        wachtwoord opnieuw kunt instellen.
    </PageHeading>
    <div v-if="props.canResetPassword"
         class="w-full sm:max-w-xl">
        <Card>
            <form class="space-y-6"
                  @submit.prevent="submit">
                <Alert v-if="status">
                    {{ status }}
                </Alert>
                <div>
                    <InputLabel for="email"
                                value="E-mailadres"
                                required/>
                    <InputText id="email"
                               type="email"
                               class="block w-full"
                               v-model="form.email"
                               required
                               autofocus
                               autocomplete="username"
                               :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.email"/>
                </div>
                <div>
                    <PrimaryButton @click="submit"
                                   class="w-full"
                                   :disabled="form.processing"
                                   spinner>
                        Wachtwoordherstel-link aanvragen
                    </PrimaryButton>
                </div>
            </form>
        </Card>
    </div>
    <Alert v-else
           title="Een nieuw wachtwoord instellen is niet mogelijk"
           type="info">
        Het is momenteel niet mogelijk om een nieuw wachtwoord in te stellen, probeer het later opnieuw.
    </Alert>
</template>
