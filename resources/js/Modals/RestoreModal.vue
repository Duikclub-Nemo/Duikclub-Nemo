<script setup>
import {useForm} from '@inertiajs/vue3';
import 'vue-advanced-cropper/dist/style.css';
import Modal from "@/Modals/Modal.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import {ArrowPathIcon} from "@heroicons/vue/24/outline/index.js";
import InputError from "@/Components/Forms/InputError.vue";
import AccentButton from "@/Components/Forms/AccentButton.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    id: {
        type: Number,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    confirmation: {
        type: String,
        required: true,
    },
    route: {
        type: String,
        required: true,
    }
})


const form = useForm({
    id: props.id,
})

const emit = defineEmits(['close'])

const close = () => {
    form.clearErrors();
    form.reset();
    emit('close');
}

const deleteObject = () => {
    form.patch(props.route, {
        preserveScroll: true,
        onSuccess: () => close(),
        onFinish: () => form.reset(),
    });
}

</script>

<template>
    <Modal :show="show"
           :title="props.title"
           @close="close">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:size-10">
                <ArrowPathIcon class="size-6 text-green-600" aria-hidden="true"/>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <div class="text-sm text-gray-500">
                    {{ props.confirmation }}
                </div>
                <InputError v-if="Object.keys(form.errors).length"
                            v-for="(message, field) in form.errors"
                            :key="field"
                            :message="message"
                            class="mt-1"/>
            </div>
        </div>
        <template #footer>
            <AccentButton class="w-full sm:w-auto"
                          color="green"
                          :disabled="form.processing"
                          @click="deleteObject">
                Herstellen
            </AccentButton>
            <SecondaryButton type="button"
                             class="w-full sm:w-auto"
                             @click="close">
                Annuleren
            </SecondaryButton>
        </template>
    </Modal>
</template>
