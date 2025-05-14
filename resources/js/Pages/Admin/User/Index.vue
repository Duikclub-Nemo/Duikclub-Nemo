<script setup>
import {Head, Link, router} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import {ref, watch} from "vue";
import {debounce, pickBy} from "lodash";
import {useAuthStore} from "@/Stores/authStore.js";
import {UsersIcon, PlusIcon, ChevronRightIcon} from "@heroicons/vue/24/outline/index.js";
import FilterDropdown from "@/Components/Layout/FilterDropdown.vue";
import InputText from "@/Components/Forms/InputText.vue";
import SortingDropdown from "@/Components/Layout/SortingDropdown.vue";
import Pagination from "@/Components/Layout/Pagination.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import InputCheckbox from "@/Components/Forms/InputCheckbox.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
    users: Object,
    filters: Object,
    filterOptions: Array,
    sortOptions: Array,
})

const auth = useAuthStore()

const params = ref({
    search: props.filters.search,
    field: props.filters.field ?? 'last_name',
    direction: props.filters.direction ?? 'asc',
    places: props.filters.places ?? [],
    certificates: props.filters.certificates ?? [],
    roles: props.filters.roles ?? [],
    archived: props.filters.archived === true || props.filters.archived === 'true',
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
    params.value.archived = false;
}

watch(params, debounce(function (params) {
        const queryParams = {
            ...pickBy(params),
            places: params.places.length ? params.places.join(',') : undefined,
            certificates: params.certificates.length ? params.certificates.join(',') : undefined,
            roles: params.roles.length ? params.roles.join(',') : undefined,
        };
        router.get(route('admin.user.index'), pickBy(queryParams), {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        });
    }, 200),
    {
        deep: true
    });

function impersonate(id, fullname) {
    if (confirm(`Weet je zeker dat je wilt inloggen als ${fullname}?`)) {
        router.post(route('admin.impersonate.login', id), {}, {})
    }
}
</script>

<template>
    <Head title="Ledenbeheer"/>
    <PageHeading title="Ledenbeheer">
        Beheer hier alle leden van Duikclub Nemo. Je kunt ledengegevens inzien, aanpassen, nieuwe leden toevoegen of archiveren.
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
                    <div v-if="auth.hasPermission('user.viewAny')"
                         class="ml-0 md:ml-3 flex items-center">
                        <InputCheckbox id="former"
                                       v-model:checked="params.archived"/>
                        <label for="former"
                               class="ml-2 text-sm text-gray-700 hover:text-gray-900">
                            Verwijderde leden
                        </label>
                    </div>
                </div>
                <div v-if="auth.hasPermission('user.create')"
                     class="flex flex-col items-stretch justify-end flex-shrink-0 w-full pb-3 md:pb-0 md:w-auto md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <Link :href="route('admin.user.create')"
                          class="w-full md:w-fit">
                        <PrimaryButton class="w-full">
                            <PlusIcon class="size-5 mr-2" aria-hidden="true"/>
                            Lid toevoegen
                        </PrimaryButton>
                    </Link>
                </div>
            </div>
        </template>
        <div v-if="props.users.data.length > 0">
            <ul role="list"
                class="divide-y divide-gray-200">
                <li v-for="user in props.users.data"
                    :key="user.uuid"
                    class="group flex items-center justify-between py-2 hover:bg-gray-50 transition overflow-hidden">
                    {{ user }}
                    <button @click="impersonate(user.id, user.fullname)" class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700 transition">
                        Login als {{ user.fullname }}
                    </button>
                    <div class="ml-4 flex-shrink-0 text-gray-400">
                        <Link :href="route('admin.user.show', user.id)">
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
