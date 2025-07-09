<script setup>
import {onMounted, ref} from 'vue';

const model = defineModel({
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <input ref="input"
           v-model="model"
           class="block w-full rounded-md sm:rounded-lg bg-white px-3 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500 sm:text-sm/6 shadow-xs disabled:opacity-25 disabled:cursor-not-allowed transition ease-in-out duration-300 appearance-none"/>
</template>
