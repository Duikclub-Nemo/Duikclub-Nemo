<script setup>
import {computed, reactive, ref, watch} from 'vue';
import {Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {ChevronDownIcon, FunnelIcon as FunnelOutline} from "@heroicons/vue/24/outline/index.js";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputCheckbox from "@/Components/Forms/InputCheckbox.vue";

const props = defineProps({
    filters: {
        type: Array,
        required: true
    },
    searchFilters: {
        type: Boolean,
        default: false
    },
    initialFilters: {
        type: Object,
        default: () => {}
    }
});

const emit = defineEmits(['filter']);

const activeAccordion = ref(null);
const selectedFilters = reactive({});
const searchQueries = reactive({});

props.filters.forEach(filter => {
    if(props.initialFilters[filter.column]) {
        selectedFilters[filter.column] = props.initialFilters[filter.column]?.split(',').map(item => item.trim());
    } else {
        selectedFilters[filter.column] = [];
    }
});

props.filters.forEach(filter => {
    searchQueries[filter.column] = '';
});

const filteredChoices = (filter) => {
    if (!searchQueries[filter.column]) return filter.choices;
    return filter.choices.filter(choice =>
        choice.label.toLowerCase().includes(searchQueries[filter.column].toLowerCase())
    );
};

watch(selectedFilters, (newFilters) => {
    emit('filter', {...newFilters});
}, {deep: true});

const overallCount = computed(() => {
    let total = 0;
    for (const key in selectedFilters) {
        total += selectedFilters[key].length;
    }
    return total;
});

const toggleAccordion = (column) => {
    activeAccordion.value = activeAccordion.value === column ? null : column;
};

const resetFilters = () => {
    for (const key in selectedFilters) {
        selectedFilters[key] = [];
    }
    emit('filter', {...selectedFilters});
};
</script>

<template>
    <Popover class="relative">
        <PopoverButton :as="SecondaryButton"
                       class="w-full">
            <FunnelOutline class="size-5 mr-2" aria-hidden="true"/>
            Filteren
            <span v-if="overallCount > 0"
                  class="inline-flex items-center ml-3 rounded-md bg-gray-300 px-2 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset">
                {{ overallCount }}
            </span>
        </PopoverButton>
        <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel
                class="absolute right-0 sm:left-0 z-5 mt-2 w-80 origin-top-right divide-y divide-gray-300 rounded-md bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden">
                <div v-for="(filter, index) in filters"
                     :key="index">
                    <button @click="toggleAccordion(filter.column)"
                            type="button"
                            class="w-full flex justify-between items-center px-4 py-2 text-left text-sm font-medium text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                        <span>{{ filter.label }}</span>
                        <span class="flex items-center">
                            <span v-if="selectedFilters[filter.column].length"
                                  class="inline-flex items-center rounded-md bg-gray-200 px-2 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset">
                                 {{ selectedFilters[filter.column].length }}
                            </span>
                            <ChevronDownIcon class="size-5 ml-2 transform transition-transform duration-200"
                                             :class="{ 'rotate-180': activeAccordion === filter.column }"/>
                        </span>
                    </button>
                    <div v-show="activeAccordion === filter.column">
                        <div v-if="props.searchFilters"
                             class="px-4 pt-2">
                            <InputText type="search"
                                       v-model="searchQueries[filter.column]"
                                       placeholder="Zoek in deze categorie..."/>
                        </div>
                        <ul class="py-1 space-y-1 overflow-y-auto max-h-60 scrollbar-thin">
                            <li v-for="(choice, cIndex) in filteredChoices(filter)"
                                :key="cIndex"
                                class="flex items-center py-1 px-4 hover:bg-gray-50">
                                <InputCheckbox :id="filter.column + '-' + choice.value"
                                               :value="choice.value"
                                               v-model:checked="selectedFilters[filter.column]"/>
                                <label :for="filter.column + '-' + choice.value"
                                       class="ml-2 text-sm text-gray-700 hover:text-gray-900">
                                    {{ choice.label }} ({{ choice.count }})
                                </label>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="p-2">
                    <SecondaryButton @click="resetFilters"
                                     type="button"
                                     class="w-full">
                        Reset filters
                    </SecondaryButton>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>
