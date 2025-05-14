<script setup>
import {useSlots} from "vue";

const props = defineProps({
    title: String,
})
</script>

<template>
    <div class="mt-2 mb-5">
        <div v-if="useSlots().action"
             class="mb-6">
            <slot name="action"/>
        </div>
        <h1 class="text-2xl font-medium text-gray-900 truncate">
            {{ props.title }}
        </h1>
        <div class="items-center mt-2 text-gray-500">
            <slot/>
        </div>
    </div>
</template>
