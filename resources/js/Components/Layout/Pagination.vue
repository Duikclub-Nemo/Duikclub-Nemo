<script setup>
import {Link} from "@inertiajs/vue3"
import {ArrowLongLeftIcon, ArrowLongRightIcon} from '@heroicons/vue/20/solid'

const props = defineProps({
    meta: {
        type: Object,
        required: true
    },
    stats: {
        type: Boolean,
        default: false,
        required: false
    },
    only: {
        type: Array,
        default: []
    }
})
</script>

<template>
    <div>
        <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
            <template v-for="page in props.meta.links">
                <div v-if="page.label === 'Vorige'"
                     class="-mt-px flex w-0 flex-1">
                    <Link v-if="page?.url"
                          :href="page?.url"
                          :only="only"
                          class="inline-flex items-center border-t-2 border-transparent pr-4 pt-4 text-sm font-medium text-gray-600"
                          :class="{ 'text-gray-100 hover:border-gray-300 hover:text-gray-900' : page?.url}">
                        <ArrowLongLeftIcon class="mr-3 h-5 w-5" aria-hidden="true"/>
                        {{ page?.label }}
                    </Link>
                </div>
                <div v-else-if="page.label === 'Volgende'"
                     class="-mt-px flex w-0 flex-1 justify-end">
                    <Link v-if="page?.url"
                          :href="page?.url"
                          :only="only"
                          class="inline-flex items-center border-t-2 border-transparent pl-4 pt-4 text-sm font-medium text-gray-600"
                          :class="{ 'hover:border-gray-300 hover:text-gray-900' : page?.url}">
                        {{ page?.label }}
                        <ArrowLongRightIcon class="ml-3 h-5 w-5" aria-hidden="true"/>
                    </Link>
                </div>
                <div v-else
                     class="hidden md:-mt-px md:flex">
                    <Component :is="page?.url && !page?.active ? Link : 'span'"
                               :href="page?.url"
                               :only="only"
                               class="inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium text-gray-600"
                               :class="{
                           'border-primary-500 text-primary-600': page?.active,
                           'border-transparent hover:border-gray-300 hover:text-gray-900': !page?.active && page?.url,
                           'border-transparent' : !page?.url
                       }"
                               :aria-current="page.active ? 'page' : undefined">
                        {{ page.label }}
                    </Component>
                </div>
            </template>
        </nav>
        <div v-if="props.stats"
             class="flex items-center justify-center md:justify-end mt-3">
            <div>
                <p class="text-sm text-gray-600">
                    Resultaat
                    <span class="font-medium">{{ props.meta.from ?? 0 }}</span>
                    tot
                    <span class="font-medium">{{ props.meta.to ?? 0 }}</span>
                    van
                    <span class="font-medium">{{ props.meta.total }}</span>
                </p>
            </div>
        </div>
    </div>
</template>
