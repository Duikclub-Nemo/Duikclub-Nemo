<script setup>
import {EnvelopeIcon, PhoneIcon} from "@heroicons/vue/24/outline/index.js";
import {format} from "date-fns";
import {nl} from "date-fns/locale";
import Avatar from "@/Components/Layout/Avatar.vue";

const props = defineProps({
    user: Object,
})

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Persoonsgegevens
            </h2>
        </header>
        <div class="flex flex-col md:flex-row mt-6 gap-4 md:gap-8 lg:gap-14">
            <div class="flex-1 space-y-3 md:space-y-2 order-2 md:order-1">
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Naam
                    </div>
                    <div>
                        {{ props.user.first_name }} ({{ props.user.initials }}) {{ props.user.last_name }}
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Geboren
                    </div>
                    <div>
                        {{ format(props.user.date_of_birth, 'd MMMM yyyy', {locale: nl}) }} ({{ props.user.age }}
                        jaar) ({{ props.user.gender }})
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Adres
                    </div>
                    <div class="select-all">
                        {{ props.user.street }}<br>
                        {{ props.user.zipcode }} {{ props.user.place }} ({{ props.user.country }})
                    </div>
                </div>
                <div class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        E-mailadres
                    </div>
                    <div>
                        <a class="flex items-center w-fit default-link"
                           :href="'mailto:'+ props.user.email">
                            {{ props.user.email }}
                            <EnvelopeIcon class="size-4 ml-2" aria-hidden="true"/>
                        </a>
                    </div>
                </div>
                <div v-if="props.user.phone_number"
                     class="space-y-0 md:space-y-0 md:flex md:items-stretch md:space-x-3">
                    <div class="text-sm font-medium w-45 text-gray-500 md:pt-1 md:border-r border-gray-500 md:pr-5">
                        Telefoon
                    </div>
                    <div>
                        <a class="flex items-center w-fit default-link"
                           :href="'tel:'+ props.user.phone_number">
                            {{ props.user.phone_number }}
                            <PhoneIcon class="size-4 ml-2" aria-hidden="true"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-start order-1 md:order-2">
                <Avatar class="size-50 md:size-60 md:-mt-12"
                        :url="props.user.avatar"
                        :alt="props.user.fullname"/>
            </div>
        </div>
    </section>
</template>
