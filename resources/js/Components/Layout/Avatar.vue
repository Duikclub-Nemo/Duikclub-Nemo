<script setup>
import {UserIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    url: String,
    alt: String,
})
</script>

<template>
    <div>
        <div class="relative h-full w-full inline-block flex-none rounded-full overflow-hidden">
            <img v-if="props.url"
                 class="object-cover w-full h-full"
                 :src="props.url"
                 :alt="props.alt"/>
            <div v-else
                 class="object-cover w-full h-full bg-gray-500">
                <UserIcon class="object-cover text-white"/>
            </div>
            <div class="absolute inset-0 border-2 border-black/10 rounded-full"></div>
        </div>
    </div>
</template>
