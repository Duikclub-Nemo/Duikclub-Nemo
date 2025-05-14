<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import Card from "@/Components/Layout/Card.vue";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Alert from "@/Components/Layout/Alert.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputCheckbox from "@/Components/Forms/InputCheckbox.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
    canLogin: Boolean,
    canResetPassword: Boolean,
    canRegister: Boolean,
    status: String
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})


const submit = () => {
    form.clearErrors()
    form.post(route('login'), {
        onFinish: () => form.reset('password')
    })
}
</script>

<template>
    <Head title="Inloggen"/>
    <PageHeading title="Inloggen">
        Het ledengedeelte is exclusief toegankelijk voor leden van Duikclub Nemo. Ben je benieuwd naar wat onze duikclub
        te bieden heeft of overweeg je lid te worden? Neem dan een kijkje op onze
        <Link :href="route('about.about')" class="default-link">informatiepagina</Link>
        !
    </PageHeading>
    <div v-if="props.canLogin"
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
                    <InputLabel for="password"
                                value="Wachtwoord"
                                required/>
                    <InputText
                        id="password"
                        type="password"
                        class="block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.password"/>
                </div>
                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-start">
                            <span class="flex items-center h-5">
                                <InputCheckbox id="remember"
                                               :disabled="form.processing"
                                               v-model:checked="form.remember"/>
                            </span>
                        <span class="ml-3 text-sm">
                                Onthoud mij
                            </span>
                    </label>
                </div>
                <div>
                    <PrimaryButton @click="submit"
                                   class="w-full"
                                   :disabled="form.processing"
                                   spinner>
                        Inloggen
                    </PrimaryButton>
                </div>
                <div class="text-sm font-light">
                    <Link v-if="canResetPassword"
                          :href="route('password.forgot')"
                          class="default-link">
                        Wachtwoord vergeten?
                    </Link>
                    <p v-if="canRegister">
                        Nog geen account?
                        <Link :href="route('register')"
                              class="default-link">
                            Registreer je hier!
                        </Link>
                    </p>
                </div>
            </form>
        </Card>
    </div>
    <Alert v-else
           title="Inloggen is momenteel uitgeschakeld"
           type="info">
        Het is momenteel niet mogelijk om te in loggen, probeer het later opnieuw.
    </Alert>
</template>
