<script setup>
import {defineAsyncComponent, ref} from "vue";
import {Head, Link} from '@inertiajs/vue3'
import {format} from "date-fns";
import {nl} from "date-fns/locale";
import {ChevronLeftIcon, PencilIcon, TrashIcon} from "@heroicons/vue/24/outline/index.js";
import {useAuthStore} from "@/Stores/authStore.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import DangerButton from "@/Components/Forms/DangerButton.vue";

const props = defineProps({
    certificate: Object,
})

const auth = useAuthStore()

const isDeleteModal = ref(false)

const DeleteModal = defineAsyncComponent(() =>
    import('@/Modals/DeleteModal.vue'))
</script>

<template>
    <Head title="Mijn Brevetten"/>
    <PageHeading title="Mijn Brevetten">
        <template #action>
            <Link :href="route('member.certificate.index')"
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
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-900 text-center md:text-left">
                    {{ props.certificate.title }}
                </h2>
                <div class="flex gap-2 w-full md:w-auto">
                    <Link v-if="auth.hasPermission('member.certificate.edit')"
                          :href="route('member.certificate.edit', props.certificate.id)"
                          class="w-full">
                        <SecondaryButton class="w-full">
                            <PencilIcon class="size-4 mr-3"/>
                            Wijzig
                        </SecondaryButton>
                    </Link>
                    <DangerButton class="w-full"
                                  v-if="auth.hasPermission('member.certificate.delete')"
                                  @click="isDeleteModal=true">
                        <TrashIcon class="size-4 mr-3"/>
                        Verwijder
                    </DangerButton>
                </div>
            </div>
        </template>
        <div class="flex-1 space-y-3 md:space-y-2 order-2 md:order-1">
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Brevet
                </div>
                <div>
                    {{ certificate.title }}
                </div>
            </div>
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Brevettype
                </div>
                <div>
                    {{ certificate.certificate_type }}
                </div>
            </div>
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Uitgegeven
                </div>
                <div>
                    {{ format(certificate.date_of_issue, 'd MMMM yyyy', {locale: nl}) }}
                </div>
            </div>
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Brevetnummer
                </div>
                <div>
                    {{ certificate.certificate_number }}
                </div>
            </div>
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Organisatie
                </div>
                <div>
                    {{ certificate.federation }}
                </div>
            </div>
            <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                    Toegevoegd
                </div>
                <div>
                    {{ format(certificate.created_at, 'd MMMM yyyy', {locale: nl}) }}
                </div>
            </div>
        </div>
    </Card>

    <DeleteModal :show="isDeleteModal"
                 title="Brevet verwijderen"
                 :confirmation="`Weet je zeker dat je het brevet '${props.certificate.title}' wilt verwijderen?`"
                 :id="props.certificate.id"
                 :route="route('member.certificate.destroy', props.certificate.id)"
                 @close="isDeleteModal = false"/>
</template>
