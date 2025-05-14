<script setup>
import {Link} from '@inertiajs/vue3';
import {format} from "date-fns";
import {nl} from "date-fns/locale";
import {PhoneIcon} from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    user: Object,
})
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Duikgegevens
            </h2>
            <p class="mt-1 text-gray-600">
                Onderstaande informatie is bij ons bekend. Je kunt jouw brevet aanpassen via
                <Link class="default-link" :href="route('member.certificate.index')">Mijn Brevetten</Link>
            </p>
        </header>
        <div class="md:flex mt-6">
            <div class="md:w-1/2 space-y-3 md:space-y-2">
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div
                        class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Brevet
                    </div>
                    <div>
                        {{ props.user.certificate }}
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div
                        class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Duikbond
                    </div>
                    <div>
                        {{ props.user.federation }}
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div
                        class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Lidnummer
                    </div>
                    <div>
                        {{ props.user.federation_membership }}
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div
                        class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Medische (zelf-)check
                    </div>
                    <div>
                        {{ format(props.user.medical_check, 'd MMMM yyyy', {locale: nl}) }}
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div
                        class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Aantal duiken
                    </div>
                    <div>
                        {{ props.user.dives }}
                    </div>
                </div>
            </div>
            <div v-if="props.user.ice_name || props.user.ice_phone_number"
                 class="md:w-1/2 mt-6 sm:mt-4 md:mt-0">
                <div class="rounded-xl p-4 bg-red-50 text-red-700">
                    <div class="space-y-3 md:space-y-2">
                        <h3>In Case of Emergency</h3>
                        <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                            <div
                                class="text-sm font-medium w-30 md:pt-1 md:border-r border-red-700 md:pr-5">
                                Contactpersoon
                            </div>
                            <div>
                                {{ props.user.ice_name }}
                            </div>
                        </div>
                        <div v-if="props.user.ice_phone_number"
                             class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                            <div
                                class="text-sm font-medium w-30 md:pt-1 md:border-r border-red-700 md:pr-5">
                                Telefoon
                            </div>
                            <div>
                                <a class="flex items-center w-fit underline hover:text-red-600"
                                   :href="'tel:'+ props.user.ice_phone_number">
                                    {{ props.user.ice_phone_number }}
                                    <PhoneIcon class="size-4 ml-2" aria-hidden="true"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>
