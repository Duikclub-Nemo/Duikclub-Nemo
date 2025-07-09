<script setup>
import {computed} from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Boolean, Array],
        required: true,
    },
    value: {
        default: null,
    },
    id: String,
    disabled: {
        type: Boolean,
        default: false
    }
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div class="group grid size-4 grid-cols-1">
        <input type="checkbox"
               :id="props.id"
               :value="props.value"
               :disabled="props.disabled"
               v-model="proxyChecked"
               class="size-4 col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-600 checked:bg-primary-600 indeterminate:border-primary-600 indeterminate:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 disabled:opacity-25 disabled:cursor-not-allowed forced-colors:appearance-auto transition ease-in-out duration-300"/>
        <svg
            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:opacity-25"
            viewBox="0 0 14 14" fill="none">
            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</template>

