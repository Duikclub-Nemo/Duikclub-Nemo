<script setup>
import {computed} from "vue";
import {CheckCircleIcon, ExclamationTriangleIcon, InformationCircleIcon, XCircleIcon} from '@heroicons/vue/24/solid'

const props = defineProps({
    title: {
        type: String,
        required: false
    },
    type: {
        type: String,
        required: false,
        default: 'info'
    }
})

const WrapperClass = computed(() => {
    switch (props.type) {
        case 'danger':
            return 'bg-red-50'
        case 'info':
            return 'bg-blue-50'
        case 'success':
            return 'bg-green-50'
        case 'warning':
            return 'bg-yellow-50'
    }
})

const Icon = computed(() => {
    switch (props.type) {
        case 'danger':
            return XCircleIcon
        case 'info':
            return InformationCircleIcon
        case 'success':
            return CheckCircleIcon
        case 'warning':
            return ExclamationTriangleIcon
    }
})

const IconStyle = computed(() => {
    switch (props.type) {
        case 'danger':
            return 'text-red-400'
        case 'info':
            return 'text-blue-400'
        case 'success':
            return 'text-green-400'
        case 'warning':
            return 'text-yellow-400'
    }
})


const TextStyle = computed(() => {
    switch (props.type) {
        case 'danger':
            return 'text-red-700'
        case 'info':
            return 'text-blue-700'
        case 'success':
            return 'text-green-700'
        case 'warning':
            return 'text-yellow-700'
    }
})
</script>

<template>
    <div class="rounded-xl p-4" :class="WrapperClass">
        <div class="flex">
            <div class="shrink-0">
                <Component :is="Icon" class="size-6" :class="IconStyle" aria-hidden="true"/>
            </div>
            <div class="ml-3">
                <h3 v-if="props.title" class="mb-1 font-medium" :class="TextStyle">{{ props.title }}</h3>
                <div class="text-sm" :class="TextStyle">
                    <slot/>
                </div>
            </div>
        </div>
    </div>

</template>
