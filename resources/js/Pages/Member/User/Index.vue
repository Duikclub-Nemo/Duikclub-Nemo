<script setup>
import {ref, watch} from "vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {debounce, pickBy} from "lodash";
import {ChevronRightIcon, UsersIcon} from "@heroicons/vue/24/outline";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import Pagination from "@/Components/Layout/Pagination.vue";
import InputText from "@/Components/Forms/InputText.vue";
import SortingDropdown from "@/Components/Layout/SortingDropdown.vue";
import FilterDropdown from "@/Components/Layout/FilterDropdown.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import Avatar from "@/Components/Layout/Avatar.vue";

const props = defineProps({
    users: Object,
    filters: Object,
    filterOptions: Array,
    sortOptions: Array,
})

const params = ref({
    search: props.filters.search,
    field: props.filters.field ?? 'last_name',
    direction: props.filters.direction ?? 'asc',
    places: props.filters.places ?? [],
    certificates: props.filters.certificates ?? [],
    roles: props.filters.roles ?? [],
});

const updateSort = ({column, direction}) => {
    params.value.field = column;
    params.value.direction = direction;
};

function handleFilter(newFilters) {
    params.value.places = newFilters.places || [];
    params.value.certificates = newFilters.certificates || [];
    params.value.roles = newFilters.roles || [];
}

function resetFilter() {
    params.value.search = null;
    params.value.places = [];
    params.value.certificates = [];
    params.value.roles = [];
}

watch(params, debounce(function (params) {
        const queryParams = {
            ...pickBy(params),
            places: params.places.length ? params.places.join(',') : undefined,
            certificates: params.certificates.length ? params.certificates.join(',') : undefined,
            roles: params.roles.length ? params.roles.join(',') : undefined,
        };
        router.get(route('member.user.index'), pickBy(queryParams), {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        });
    }, 200),
    {
        deep: true
    });
</script>

<template>
    <Head title="Ledenlijst"/>
    <PageHeading title="Ledenlijst">
        Hier vind je een overzicht van alle leden van Duikclub Nemo.
        Gebruik de lijst om eenvoudig contact te leggen met medeleden of om elkaar sneller te vinden tijdens trainingen
        en activiteiten.
    </PageHeading>
    <Card>
        <template #header>
            <div
                class="flex flex-col-reverse items-stretch justify-between md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-3">
                <div class="flex flex-col w-full space-y-3 lg:w-2/3 md:space-y-0 md:flex-row md:items-center">
                    <div class="flex-1 w-full md:max-w-xs md:mr-4">
                        <InputText type="search"
                                   class="block w-full"
                                   v-model="params.search"
                                   placeholder="Lid zoeken..."/>
                    </div>
                    <div class="flex flex-wrap md:flex-nowrap gap-3">
                        <SortingDropdown class="flex-1 md:flex-none"
                                         :columns="props.sortOptions"
                                         :sortColumn="params.field"
                                         :sortDirection="params.direction"
                                         @sort="updateSort"/>
                        <FilterDropdown class="flex-1 md:flex-none"
                                        :filters="props.filterOptions"
                                        :initialFilters="props.filters"
                                        :searchFilters="true"
                                        @filter="handleFilter"/>
                    </div>
                </div>
            </div>
        </template>
        <div v-if="props.users.data.length > 0">
            <ul role="list"
                class="divide-y divide-gray-200">
                <li v-for="user in props.users.data"
                    :key="user.uuid"
                    class="group flex items-center justify-between py-2 hover:bg-gray-50 transition overflow-hidden">
                    <div class="flex items-center space-x-4 overflow-hidden">
                        <Link :href="route('member.user.show', user.uuid)">
                            <Avatar class="size-14"
                                    :url="user.avatar"
                                    :alt="user.fullname"/>
                        </Link>
                        <div class="flex flex-col">
                            <div class="font-medium text-lg text-gray-900">
                                <Link :href="route('member.user.show', user.uuid)">
                                    {{ user.fullname }}
                                </Link>
                            </div>
                            <div class="text-gray-500">
                                {{ user.certificate }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center space-x-4 flex-1 justify-end overflow-hidden">
                        <div class="hidden xl:flex text-gray-700 truncate w-[160px]">
                            {{ user.place }}
                        </div>
                        <div class="hidden sm:flex text-gray-700 truncate w-[160px]">
                            <a :href="'tel:' + user.phone_number">
                                {{ user.phone_number }}
                            </a>
                        </div>
                        <div class="hidden lg:flex text-gray-700 truncate w-[240px]">
                            <a :href="'mailto:' + user.email">
                                {{ user.email }}
                            </a>
                        </div>
                    </div>
                    <div class="ml-4 flex-shrink-0 text-gray-400">
                        <Link :href="route('member.user.show', user.uuid)">
                            <ChevronRightIcon class="size-6"/>
                        </Link>
                    </div>
                </li>
            </ul>
            <Pagination :meta="users.meta"
                        :stats="true"
                        :only="['users']"/>
        </div>
        <div v-else>
            <div class="text-center py-6">
                <UsersIcon class="mx-auto size-12 text-gray-500" aria-hidden="true"/>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Geen leden gevonden</h3>
                <p class="mt-1 text-sm text-gray-500">Mogelijk is er een filter actief, of zijn er nog geen
                    leden aangemaakt.</p>
                <div class="flex mt-6 justify-center">
                    <SecondaryButton type="button"
                                     @click="resetFilter">
                        Reset filters
                    </SecondaryButton>
                </div>
            </div>
        </div>
    </Card>
</template>
