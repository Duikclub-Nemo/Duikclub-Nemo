<script setup>
import {Deferred, Head, Link} from '@inertiajs/vue3'
import {format} from "date-fns";
import {nl} from "date-fns/locale";
import {ChevronLeftIcon} from "@heroicons/vue/24/outline/index.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import ProfileInformation from "@/Pages/Member/User/Partials/ProfileInformation.vue";
import AboutMeInformation from "@/Pages/Member/User/Partials/AboutMeInformation.vue";
import DiveInformation from "@/Pages/Member/User/Partials/DiveInformation.vue";
import SpinnerIcon from "@/Components/Icons/SpinnerIcon.vue";

const props = defineProps({
    user: Object,
    certificates: Object,
})
</script>

<template>
    <Head :title="user.fullname ?? 'Ledenlijst'"/>
    <PageHeading title="Ledenlijst">
        <template #action>
            <Link :href="route('member.user.index')"
                  class="flex items-center hover:text-gray-900">
                <ChevronLeftIcon class="size-5 mr-2" aria-hidden="true"/>
                <div>Terug</div>
            </Link>
        </template>
        Hier vind je een overzicht van alle leden van Duikclub Nemo.
        Gebruik de lijst om eenvoudig contact te leggen met medeleden of om elkaar sneller te vinden tijdens trainingen
        en activiteiten.
    </PageHeading>
    <div class="flex flex-col gap-6">
        <Card>
            <template #header>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-900 text-center md:text-left">
                        {{ props.user.fullname }}
                    </h2>
                </div>
            </template>
            <ProfileInformation :user="props.user"/>
        </Card>
        <Card v-if="props.user.about_me">
            <AboutMeInformation :about="props.user.about_me"/>
        </Card>
        <Card>
            <DiveInformation :user="props.user"/>
            <h2 class="text-lg font-medium text-gray-900 mt-6">
                Brevetten
            </h2>
            <div class="mt-1">
                <Deferred data="certificates">
                    <template #fallback>
                        <div>
                            <SpinnerIcon class="size-5"/>
                            Bezig met ophalen...
                        </div>
                    </template>
                    <ul role="list"
                        class="divide-y divide-gray-200">
                        <li v-for="certificate in props.certificates.data"
                            :key="certificate.id"
                            class="group flex items-center justify-between py-2 hover:bg-gray-50 transition overflow-hidden">
                            <div class="flex items-center space-x-4 overflow-hidden">
                                <div class="flex flex-col">
                                    <div class="text-gray-900">
                                        {{ certificate.title }}
                                    </div>
                                    <div class="sm:hidden text-gray-500">
                                        {{ format(certificate.date_of_issue, 'd MMMM yyyy', {locale: nl}) }}
                                    </div>
                                </div>
                            </div>
                            <div class="hidden sm:flex items-center space-x-4 flex-1 justify-end overflow-hidden">
                                <div class="hidden sm:flex text-gray-700 truncate w-[200px]">
                                    {{ format(certificate.date_of_issue, 'd MMMM yyyy', {locale: nl}) }}
                                </div>
                                <div class="hidden md:flex text-gray-700 truncate w-[160px]">
                                    {{ certificate.federation }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </Deferred>
            </div>
        </Card>
    </div>
</template>
