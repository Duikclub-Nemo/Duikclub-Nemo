<script setup>
import {useSlots} from "vue";
</script>

<template>
    <div class="w-full bg-white rounded-lg sm:rounded-xl shadow-sm">
        <div v-if="useSlots().header"
             class="p-4 sm:px-6 border-b border-gray-200">
            <slot name="header"/>
        </div>
        <div class="p-4 sm:px-6 sm:py-4">
            <slot/>
        </div>
    </div>
</template>
