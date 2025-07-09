<script setup>
import {useForm} from '@inertiajs/vue3';
import 'vue-advanced-cropper/dist/style.css';
import Modal from "@/Modals/Modal.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import {ExclamationTriangleIcon} from "@heroicons/vue/24/outline/index.js";
import {useToastStore} from "@/Stores/toastStore.js";
import DangerButton from "@/Components/Forms/DangerButton.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    uuid: {
        type: String,
    }
})

const toasts = useToastStore()

const form = useForm({
    uuid: props.uuid,
})

const emit = defineEmits(['close'])

const close = () => {
    form.clearErrors();
    form.reset();
    emit('close');
}

const deleteAvatar = () => {
    form.delete(route('avatar.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            close();
            toasts.success('Je pasfoto is verwijderd.');
        },
        onFinish: () => form.reset(),
    });
}

</script>

<template>
    <Modal :show="show"
           title="Profielfoto verwijderen"
           @close="close">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                <ExclamationTriangleIcon class="size-6 text-red-600" aria-hidden="true"/>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <div class="text-sm text-gray-500">
                    Weet je zeker dat je deze pasfoto wilt verwijderen? Deze actie kan niet meer ongedaan gemaakt
                    worden.
                </div>
            </div>
        </div>
        <template #footer>
            <DangerButton class="w-full sm:w-auto"
                          :disabled="form.processing"
                          @click="deleteAvatar">
                Verwijderen
            </DangerButton>
            <SecondaryButton class="w-full sm:w-auto"
                             :disabled="form.processing"
                             @click="close">
                Annuleren
            </SecondaryButton>
        </template>
    </Modal>
</template>
