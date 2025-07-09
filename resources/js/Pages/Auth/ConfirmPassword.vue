<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import InputText from "@/Components/Forms/InputText.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Bevestig wachtwoord"/>
    <PageHeading title="Bevestig wachtwoord">
        Dit is een beveiligd gedeelte van de applicatie. Bevestig jouw wachtwoord voordat je verdergaat.
    </PageHeading>
    <div class="w-full sm:max-w-xl">
        <Card>
            <form class="space-y-6"
                  @submit.prevent="submit">
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
                        autofocus
                        autocomplete="current-password"
                        :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.password"/>
                </div>
                <div>
                    <PrimaryButton @click="submit"
                                   class="w-full"
                                   :disabled="form.processing"
                                   spinner>
                        Bevestig
                    </PrimaryButton>
                </div>
            </form>
        </Card>
    </div>
</template>
