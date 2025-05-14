<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import {debounce, pickBy} from "lodash";
import {format} from "date-fns";
import {nl} from "date-fns/locale";
import {AcademicCapIcon, ChevronRightIcon, PlusIcon} from "@heroicons/vue/24/outline/index.js";
import {useAuthStore} from "@/Stores/authStore.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import FilterDropdown from "@/Components/Layout/FilterDropdown.vue";
import SortingDropdown from "@/Components/Layout/SortingDropdown.vue";
import InputText from "@/Components/Forms/InputText.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import Pagination from "@/Components/Layout/Pagination.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
    certificates: Object,
    filters: Object,
    filterOptions: Array,
    sortOptions: Array,
})

const auth = useAuthStore()

const params = ref({
    search: props.filters.search,
    field: props.filters.field ?? 'date_of_issue',
    direction: props.filters.direction ?? 'desc',
    certificate_type: props.filters.certificate_type ?? [],
});

const updateSort = ({column, direction}) => {
    params.value.field = column;
    params.value.direction = direction;
};

function handleFilter(newFilters) {
    params.value.certificate_type = newFilters.certificate_type || [];
}

function resetFilter() {
    params.value.search = null;
    params.value.certificate_type = [];
}

watch(params, debounce(function (params) {
        const queryParams = {
            ...pickBy(params),
            certificate_type: params.certificate_type.length ? params.certificate_type.join(',') : undefined,
        };
        router.get(route('member.certificate.index'), pickBy(queryParams), {
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
    <Head title="Mijn Brevetten"/>
    <PageHeading title="Mijn Brevetten">
        Op deze pagina kun je jouw behaalde duikbrevetten bekijken, toevoegen en beheren.
        Zo houden we samen je voortgang en kwalificaties overzichtelijk en up-to-date binnen Duikclub Nemo.
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
                                   placeholder="Brevet zoeken..."/>
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
                                        :searchFilters="false"
                                        @filter="handleFilter"/>
                    </div>
                </div>
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full pb-3 md:pb-0 md:w-auto md:flex-row md:items-center md:space-x-3">
                    <Link v-if="auth.hasPermission('member.certificate.create')"
                          :href="route('member.certificate.create')">
                        <PrimaryButton class="w-full">
                            <PlusIcon class="size-5 mr-2" aria-hidden="true"/>
                            Brevet toevoegen
                        </PrimaryButton>
                    </Link>
                </div>
            </div>
        </template>
        <div v-if="props.certificates.data.length > 0">
            <ul role="list"
                class="divide-y divide-gray-200">
                <li v-for="certificate in props.certificates.data"
                    :key="certificate.id"
                    class="group flex items-center justify-between py-2 hover:bg-gray-50 transition overflow-hidden">
                    <div class="flex items-center space-x-4 overflow-hidden">
                        <div class="flex flex-col">
                            <div class="font-medium text-lg text-gray-900">
                                <Link :href="route('member.certificate.show', certificate.id)">
                                    {{ certificate.title }}
                                </Link>
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
                        <div class="hidden lg:flex text-gray-700 truncate w-[240px]">
                            {{ certificate.certificate_number }}
                        </div>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex space-x-3 text-gray-400">
                        <Link :href="route('member.certificate.show', certificate.id)">
                            <ChevronRightIcon class="size-6"/>
                        </Link>
                    </div>
                </li>
            </ul>
            <Pagination :meta="props.certificates.meta"
                        :stats="true"
                        :only="['certificates']"/>
        </div>
        <div v-else>
            <div class="text-center py-6">
                <AcademicCapIcon class="mx-auto size-12 text-gray-500" aria-hidden="true"/>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Geen brevetten gevonden</h3>
                <p class="mt-1 text-sm text-gray-500">Mogelijk is er een filter actief, of zijn er nog geen
                    brevetten toegevoegd.</p>
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
