<script setup>
const props = defineProps({
    value: {
        type: String,
        required: true
    },
    required: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <label class="block mb-2 text-sm text-gray-900">
        <span v-if="props.value">
            {{ props.value }}
        </span>
        <span v-else>
            <slot/>
        </span>
        <span v-if="props.required" class="ml-1 text-red-500">*</span>
    </label>
</template>
