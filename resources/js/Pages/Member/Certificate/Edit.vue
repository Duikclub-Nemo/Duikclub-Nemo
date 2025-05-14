<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3'
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import {ChevronLeftIcon} from "@heroicons/vue/24/outline/index.js";
import InputText from "@/Components/Forms/InputText.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputDropdown from "@/Components/Forms/InputDropdown.vue";
import InputError from "@/Components/Forms/InputError.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import {computed, watch} from "vue";

const props = defineProps({
    certificate: Object,
    types: Array,
    certificates: Array,
    federations: Array,
})

const form = useForm({
    certificate_type: props.certificate.certificate_type,
    certificate_id: props.certificate.certificate_id,
    date_of_issue: props.certificate.date_of_issue,
    certificate_number: props.certificate.certificate_number,
    federation: props.certificate.federation,
});


const filteredCertificates = computed(() => {
    if (!form.certificate_type) return []
    return props.certificates.filter(
        cert => cert.certificate_type === form.certificate_type
    )
})

watch(() => form.certificate_type, () => {
        form.certificate_id = null
    }
)

const submit = () => {
    form.clearErrors()
    form.patch(route('member.certificate.update', props.certificate.id),{
        preserveScroll: true,
        preserveState: true
    })
}
</script>

<template>
    <Head title="Mijn Brevetten"/>
    <PageHeading title="Mijn Brevetten">
        <template #action>
            <Link :href="route('member.certificate.show', certificate.id)"
                  class="flex items-center hover:text-gray-900">
                <ChevronLeftIcon class="size-5 mr-2" aria-hidden="true"/>
                <div>Terug</div>
            </Link>
        </template>
        Op deze pagina kun je jouw behaalde duikbrevetten bekijken, toevoegen en beheren.
        Zo houden we samen je voortgang en kwalificaties overzichtelijk en up-to-date binnen Duikclub Nemo.
    </PageHeading>
    <Card>
        <template #header>
            <div
                class="flex flex-col items-stretch justify-between md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-3">
                <div
                    class="flex flex-col w-full space-y-3 lg:w-2/3 md:space-y-0 md:flex-row md:items-center">
                    <h2 class="text-lg font-medium text-gray-900 h-full">
                        Brevet wijzigen
                    </h2>
                </div>
            </div>
        </template>
        <form class="space-y-6"
              @submit.prevent="submit">
            <div>
                <InputLabel for="type"
                            value="Brevettype"
                            required/>
                <InputDropdown id="type"
                               class="block w-full"
                               v-model="form.certificate_type"
                               :options="props.types"
                               required
                               :disabled="form.processing"/>
                <InputError class="mt-1"
                            :message="form.errors.certificate_type"/>
            </div>
            <div>
                <InputLabel for="certificate"
                            value="Brevet"
                            required/>
                <InputDropdown id="certificate"
                               class="block w-full"
                               v-model="form.certificate_id"
                               :options="filteredCertificates"
                               required
                               :disabled="form.processing || form.certificate_type === ''"/>
                <InputError class="mt-1"
                            :message="form.errors.certificate_id"/>
            </div>
            <div>
                <InputLabel for="date_of_issue"
                            value="Uitgegeven"
                            required/>
                <InputText id="date_of_issue"
                           type="date"
                           class="block w-full"
                           v-model="form.date_of_issue"
                           required
                           :disabled="form.processing || form.certificate_type === ''"/>
                <InputError class="mt-1"
                            :message="form.errors.date_of_issue"/>
            </div>
            <div>
                <InputLabel for="certificate_number"
                            value="Brevetnummer"/>
                <InputText id="certificate_number"
                           type="text"
                           class="block w-full"
                           v-model="form.certificate_number"
                           :disabled="form.processing || form.certificate_type === ''"/>
                <InputError class="mt-1"
                            :message="form.errors.certificate_number"/>
            </div>
            <div>
                <InputLabel for="federation"
                            value="Organisatie"
                            required/>
                <InputDropdown id="federation"
                               class="block w-full"
                               v-model="form.federation"
                               :options="federations"
                               required
                               :disabled="form.processing || form.certificate_type === ''"/>
                <InputError class="mt-1"
                            :message="form.errors.federation"/>
            </div>
            <div>
                <PrimaryButton @click="submit"
                               class="w-full"
                               :disabled="form.processing"
                               spinner>
                    Opslaan
                </PrimaryButton>
            </div>
        </form>
    </Card>
</template>
