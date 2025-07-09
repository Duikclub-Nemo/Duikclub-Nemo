<script setup>
import {computed} from 'vue'
import {Listbox, ListboxButton, ListboxOption, ListboxOptions} from '@headlessui/vue'
import {CheckIcon, ChevronDownIcon} from '@heroicons/vue/20/solid'

const props = defineProps({
    modelValue: {type: [String, Number, null], required: true},
    options: {
        type: Array,
        required: true,
        validator: (options) => options.every(opt => opt.value !== undefined && opt.value !== '')
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    id: {
        type: String,
        default: () => `listbox-${Math.random().toString(36).substring(2, 9)}`
    }
})

const emit = defineEmits(['update:modelValue'])

const selectedOption = computed(() =>
    props.options.find(option => option.value === props.modelValue)
)
</script>

<template>
    <Listbox :modelValue="modelValue"
             @update:modelValue="emit('update:modelValue', $event)"
             :disabled="disabled"
             :id="id"
             class="disabled:opacity-25">
        <div class="relative">
            <ListboxButton
                class="block w-full rounded-md sm:rounded-lg bg-white px-3 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500 sm:text-sm/6 shadow-xs disabled:opacity-25 disabled:cursor-not-allowed transition ease-in-out duration-300 appearance-none text-left">
                <span>{{ selectedOption?.label ?? 'Selecteer een optie' }}</span>
                <ChevronDownIcon
                    class="pointer-events-none absolute right-3 top-1/2 size-5 -translate-y-1/2 text-gray-400"/>
            </ListboxButton>
            <transition enter-active-class="transition ease-out duration-100"
                        enter-from-class="opacity-0 -translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 -translate-y-1">
                <ListboxOptions
                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm scrollbar-thin">
                    <ListboxOption v-for="option in options"
                                   :key="option.value"
                                   :value="option.value"
                                   class="relative cursor-pointer select-none py-2 pl-10 pr-4 text-gray-900 hover:bg-gray-100"
                                   v-slot="{ selected }">
                        <span :class="['block truncate', selected ? 'font-medium' : 'font-normal']">
                            {{ option.label }}
                        </span>
                        <span v-if="selected"
                              class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary-500">
                            <CheckIcon class="size-5" aria-hidden="true"/>
                        </span>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>
