<script setup>
import {ref} from "vue";
import {Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {ArrowsUpDownIcon, BarsArrowDownIcon, BarsArrowUpIcon} from '@heroicons/vue/24/solid';
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const props = defineProps({
    columns: {
        type: Array,
        required: true
    },
    sortColumn: String,
    sortDirection: String
});

const emit = defineEmits(['sort']);

const selectedColumn = ref(props.sortColumn);
const selectedDirection = ref(props.sortDirection);

const handleColumnSelect = (column) => {
    selectedColumn.value = column;
    emit("sort", {column: selectedColumn.value, direction: selectedDirection.value});
};

const handleSort = (direction) => {
    selectedDirection.value = direction;
    emit("sort", {column: selectedColumn.value, direction: selectedDirection.value});
};
</script>

<template>
    <Popover class="relative">
        <PopoverButton :as="SecondaryButton"
                       class="w-full">
            <ArrowsUpDownIcon class="size-5 mr-2"/>
            Sorteren
        </PopoverButton>
        <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">
            <PopoverPanel v-slot="{ close }"
                          class="absolute left-0 z-5 mt-2 w-60 origin-top-right divide-y divide-gray-300 rounded-md bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden">
                <ul>
                    <li v-for="(col, index) in columns"
                        :key="index"
                        @click="handleColumnSelect(col.column); close()"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:outline-hidden cursor-pointer"
                        :class="{ 'bg-gray-100 text-gray-900 outline-hidden': selectedColumn === col.column }">
                        <span class="flex-1">{{ col.label }}</span>
                    </li>
                </ul>
                <ul>
                    <li @click="handleSort('asc'); close()"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:outline-hidden cursor-pointer"
                        :class="{ 'bg-gray-100 text-gray-900 outline-hidden': selectedDirection === 'asc' }">
                        <span class="flex-1">Oplopend</span>
                        <BarsArrowDownIcon class="size-4"/>
                    </li>
                    <li @click="handleSort('desc'); close()"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:outline-hidden cursor-pointer"
                        :class="{ 'bg-gray-100 text-gray-900 outline-hidden': selectedDirection === 'desc' }">
                        <span class="flex-1">Aflopend</span>
                        <BarsArrowUpIcon class="size-4"/>
                    </li>
                </ul>
            </PopoverPanel>
        </transition>
    </Popover>
</template>
