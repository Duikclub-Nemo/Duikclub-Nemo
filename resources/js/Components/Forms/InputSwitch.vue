<script setup>
import {useSlots} from "vue";
import {Switch, SwitchGroup, SwitchLabel} from "@headlessui/vue";

const props = defineProps({
    disabled: {
        type: Boolean,
        default: false
    },
    id: {
        type: String,
        default: () => `switch-${Math.random().toString(36).substring(2, 9)}`
    }
})

const model = defineModel({
    type: Boolean,
    required: true,
});

const slots = useSlots();
const hasDefaultSlot = !!slots.default;

</script>

<template>
    <SwitchGroup as="div" class="flex items-center" :id="id">
        <Switch v-model="model"
                :disabled="props.disabled"
                :class="[model ? 'bg-primary-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2']">
            <span aria-hidden="true"
                  :class="[model ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']"/>
        </Switch>
        <SwitchLabel v-if="hasDefaultSlot" as="span" class="ml-3">
            <slot/>
        </SwitchLabel>
    </SwitchGroup>
</template>
