<script setup>
import {ref} from "vue";
import {useForm} from '@inertiajs/vue3';
import {PlusIcon} from "@heroicons/vue/24/outline";
import {CircleStencil, Cropper} from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import {useToastStore} from "@/Stores/toastStore.js";
import Modal from "@/Modals/Modal.vue";
import InputError from "@/Components/Forms/InputError.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

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
    avatar: null,
    height: null,
    width: null,
    left: null,
    top: null
})

const fileInput = ref(null)
const cropper = ref(null)
const uploadedImage = ref(null)

const emit = defineEmits(['close'])

const close = () => {
    fileInput.value = null
    cropper.value = null
    uploadedImage.value = null

    form.clearErrors()
    form.reset()

    emit('close');
}

const getUploadedImage = (e) => {
    const file = e.target.files[0]
    uploadedImage.value = URL.createObjectURL(file)
}

const crop = () => {
    const {coordinates} = cropper.value.getResult()

    form.transform((data) => ({
        ...data,
        avatar: fileInput.value.files[0],
        height: coordinates.height,
        width: coordinates.width,
        left: coordinates.left,
        top: coordinates.top
    }))
        .post(route('avatar.store'), {
            preserveScroll: false,
            onSuccess: () => {
                toasts.success('Je pasfoto is toegevoegd.');
                close()
            },
            onError: () => {
                toasts.danger('Er is iets misgegaan.');
            }
        })

}
</script>

<template>
    <Modal title="Profielfoto uploaden"
           :show="show"
           @close="close">
        <div>
            <label v-if="!uploadedImage"
                   for="image"
                   class="flex items-center justify-center font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-2 focus:outline-none focus:ring-orange-300 transition ease-in-out duration-150 cursor-pointer"
                   :class="[form.processing ? 'cursor-not-allowed bg-primary-700' : 'bg-primary-600 hover:bg-primary-700']">
                <PlusIcon class="h-5 w-5 mr-1"/>
                Selecteer profielfoto
            </label>
            <input type="file"
                   id="image"
                   ref="fileInput"
                   class="hidden"
                   @change="getUploadedImage">
        </div>
        <div v-if="uploadedImage"
             class="w-[350px] mx-auto my-5">
            <Cropper class="object-cover"
                     ref="cropper"
                     :stencil-component="CircleStencil"
                     :src="uploadedImage"/>
        </div>
        <InputError v-if="form.errors" :error="form.errors"/>
        <template #footer>
            <PrimaryButton v-if="uploadedImage"
                           class="w-full sm:w-auto"
                           :disabled="form.processing"
                           @click="crop">
                Upload
            </PrimaryButton>
            <SecondaryButton class="w-full sm:w-auto"
                             :disabled="form.processing"
                             @click="close">
                Annuleren
            </SecondaryButton>
        </template>
    </Modal>
</template>
