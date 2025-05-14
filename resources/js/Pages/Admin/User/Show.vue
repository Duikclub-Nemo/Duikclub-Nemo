<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {ChevronLeftIcon} from "@heroicons/vue/24/outline/index.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";

const props = defineProps({
    user: Object,
})
</script>

<template>
    <Head title="Ledenbeheer"/>
    <PageHeading title="Ledenbeheer">
        <template #action>
            <Link :href="route('admin.user.index')"
                  class="flex items-center hover:text-gray-900">
                <ChevronLeftIcon class="size-5 mr-2" aria-hidden="true"/>
                <div>Terug</div>
            </Link>
        </template>
        Beheer hier alle leden van Duikclub Nemo. Je kunt ledengegevens inzien, aanpassen, nieuwe leden toevoegen of archiveren.
    </PageHeading>
    <Card>
        {{ props.user }}
    </Card>
</template>
