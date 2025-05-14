<script setup>
import SpinnerIcon from "@/Components/Icons/SpinnerIcon.vue";

const props = defineProps({
    disabled: {
        type: Boolean,
        default: false
    },
    type: {
        type: String,
        default: 'button'
    },
    color: {
        type: String,
        default: 'blue',
        required: false
    },
    spinner: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <button :type="props.type"
            :disabled="props.disabled"
            class="inline-flex items-center justify-center text-sm font-medium px-5 py-2 rounded-lg focus:z-10 focus:ring-2 focus:outline-hidden disabled:opacity-25 disabled:cursor-not-allowed shadow-xs transition ease-in-out duration-200 cursor-pointer"
            :class="{
               'text-white bg-blue-700 hover:bg-blue-800 focus:ring-blue-300': props.color === 'blue',
               'text-white bg-red-700 hover:bg-red-800 focus:ring-red-300': props.color === 'red',
               'text-white bg-green-700 hover:bg-green-800 focus:ring-green-300': props.color === 'green',
               'text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-yellow-300': props.color === 'yellow',
               'text-white bg-orange-700 hover:bg-orange-800 focus:ring-orange-300': props.color === 'orange',
               'border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 ': props.color === 'transparent',
          }">
        <SpinnerIcon v-if="disabled && spinner"/>
        <slot/>
    </button>
</template>
