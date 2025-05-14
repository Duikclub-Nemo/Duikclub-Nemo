<script setup>
import {computed, onMounted} from "vue";
import {
    CheckCircleIcon,
    ExclamationTriangleIcon,
    InformationCircleIcon,
    XCircleIcon,
    XMarkIcon
} from '@heroicons/vue/24/solid'

const props = defineProps({
    type: {
        type: String,
        required: false,
        default: 'info'
    },
    message: String,
    duration: {
        type: Number,
        default: 3000
    },
})

const WrapperClass = computed(() => {
    switch (props.type) {
        case 'danger':
            return 'bg-red-50 border border-red-100'
        case 'info':
            return 'bg-blue-50 border border-blue-100'
        case 'success':
            return 'bg-green-50 border border-green-100'
        case 'warning':
            return 'bg-yellow-50 border border-yellow-100'
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

onMounted(() => {
    if (props.duration) {
        setTimeout(() => emit("remove"), props.duration)
    }
})

const emit = defineEmits(['remove'])
</script>

<template>
    <div class="flex items-center rounded-xl p-4 shadow-sm"
         :class="WrapperClass">
        <div class="inline-flex items-center justify-center flex-shrink-0">
            <Component :is="Icon"
                       class="size-7"
                       :class="IconStyle"
                       aria-hidden="true"/>
        </div>
        <div class="ms-3 text-sm font-normal">{{ props.message }}</div>
        <button @click="emit('remove')"
                type="button"
                class="ms-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                aria-label="Close">
            <span class="sr-only">Close</span>
            <XMarkIcon class="size-5"/>
        </button>
    </div>
</template>
