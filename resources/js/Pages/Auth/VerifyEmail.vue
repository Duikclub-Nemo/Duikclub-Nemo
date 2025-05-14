<script setup>
import {computed} from "vue";
import {Head, Link, useForm} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import Alert from "@/Components/Layout/Alert.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import {ArrowUpOnSquareIcon} from "@heroicons/vue/24/outline/index.js";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Bevestig e-mailadres"/>
    <PageHeading title="Bevestig e-mailadres">
        Bedankt voor het aanmelden! Zou je, voordat je begint, je e-mailadres kunnen verifiëren door op de link te
        klikken die we je zojuist hebben gemaild? Als je de e-mail niet hebt ontvangen, sturen we je graag een nieuwe.
    </PageHeading>
    <div class="w-full sm:max-w-xl">
        <Card>
            <form class="space-y-6"
                  @submit.prevent="submit">
                <Alert v-if="verificationLinkSent">
                    Er is een nieuwe verificatie-link verzonden naar het e-mailadres dat je tijdens de registratie hebt opgegeven.
                </Alert>
                <div>
                    <PrimaryButton @click="submit"
                                   class="w-full py-3"
                                   :disabled="form.processing"
                                   spinner>
                        Verificatie-e-mail opnieuw verzenden
                    </PrimaryButton>
                </div>
                <div>
                    <Link :href="route('logout')"
                          method="post"
                          class="flex w-full items-center justify-center"
                          @click="$emit('close')">
                        <SecondaryButton class="w-full">
                            <ArrowUpOnSquareIcon class="mr-1 w-6 h-6 rotate-90"/>
                            Afmelden
                        </SecondaryButton>
                    </Link>
                </div>
            </form>
        </Card>
    </div>
</template>
