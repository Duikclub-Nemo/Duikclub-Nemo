<script setup>
import {computed, useSlots} from "vue";
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {XMarkIcon} from "@heroicons/vue/24/outline";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    title: {
        type: String
    }
});

const emit = defineEmits(['close']);

const slots = useSlots();

const closeModal = () => {
    emit('close');
};

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
    }[props.maxWidth];
});
</script>

<template>
    <Teleport to="body">
        <TransitionRoot as="template"
                        :show="show">
            <Dialog class="relative z-10"
                    @close="closeModal">
                <TransitionChild as="template"
                                 enter="ease-out duration-300"
                                 enter-from="opacity-0"
                                 enter-to="opacity-100"
                                 leave="ease-in duration-200"
                                 leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/70 transition-opacity backdrop-blur-sm"/>
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center">
                        <TransitionChild as="template"
                                         enter="ease-out duration-300"
                                         enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         enter-to="opacity-100 translate-y-0 sm:scale-100"
                                         leave="ease-in duration-200"
                                         leave-from="opacity-100 translate-y-0 sm:scale-100"
                                         leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel
                                class="relative transform overflow-hidden sm:text-left rounded-lg bg-white shadow-xl transition-all w-full"
                                :class="maxWidthClass">
                                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                                    <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            @click="closeModal">
                                        <span class="sr-only">Scherm sluiten</span>
                                        <XMarkIcon class="size-6" aria-hidden="true"/>
                                    </button>
                                </div>
                                <div class="p-4 sm:p-5 space-y-4 sm:space-y-5">
                                    <DialogTitle as="h3" class="text-lg text-gray-900">
                                        {{ props.title }}
                                    </DialogTitle>
                                    <!-- Modal body -->
                                    <div>
                                        <slot/>
                                    </div>
                                    <!-- Modal footer -->
                                    <div v-if="slots.footer"
                                         class="flex flex-col sm:flex-row items-center justify-end gap-3">
                                        <slot name="footer"/>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </Teleport>
</template>
