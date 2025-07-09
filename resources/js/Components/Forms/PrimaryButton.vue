<script setup>
import SpinnerIcon from "@/Components/Icons/SpinnerIcon.vue";

defineProps({
    disabled: {
        type: Boolean,
        default: false
    },
    type: {
        type: String,
        default: 'button'
    },
    spinner: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <button :type="type"
            :disabled="disabled"
            class="inline-flex items-center justify-center text-sm font-medium px-5 py-2 rounded-lg focus:z-10 text-white bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:outline-hidden focus:ring-primary-600 disabled:opacity-25 disabled:cursor-not-allowed shadow-xs transition ease-in-out duration-200 cursor-pointer">
        <SpinnerIcon v-if="disabled && spinner"/>
        <slot/>
    </button>
</template>
