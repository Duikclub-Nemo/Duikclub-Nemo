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
    email: String,
    token: String,
    canResetPassword: Boolean,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Wachtwoord resetten"/>
    <PageHeading title="Wachtwoord resetten">
        Hieronder kun je een nieuw wachtwoord instellen. Vul jouw gewenste wachtwoord in en bevestig het. Zo kun je
        straks weer veilig inloggen.
    </PageHeading>
    <div v-if="props.canResetPassword"
         class="w-full sm:max-w-xl">
        <Card>
            <form class="space-y-6"
                  @submit.prevent="submit">
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
                    <InputLabel for="password"
                                value="Nieuw wachtwoord"
                                required/>
                    <InputText
                        id="password"
                        type="password"
                        class="block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.password"/>
                </div>
                <div>
                    <InputLabel for="password_confirmation"
                                value="Bevestig nieuw wachtwoord"
                                required/>
                    <InputText
                        id="password_confirmation"
                        type="password"
                        class="block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.password_confirmation"/>
                </div>
                <div>
                    <PrimaryButton @click="submit"
                                   class="w-full"
                                   :disabled="form.processing"
                                   spinner>
                        Wachtwoord resetten
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
