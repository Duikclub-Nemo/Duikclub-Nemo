<script setup>
import Modal from "@/Modals/Modal.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
})

const emit = defineEmits(['close', 'displayuserlist']);

const close = () => {
    emit('close');
}
</script>

<template>
    <Modal :show="show"
           title="Privacy Mode"
           @close="close">
        <div class="flex flex-col space-y-3">
            <div>
                Als lid kan je ervoor kiezen om niet zichtbaar te zijn op de ledenlijst. De ledenlijst is alleen in te
                zien door geregistreerde leden.
            </div>
            <div>
                Wanneer je niet zichtbaar wilt zijn op de ledenlijst kan je de ledenlijst zelf ook niet inzien.
            </div>
        </div>

        <template #footer>
            <PrimaryButton class="w-full sm:w-auto"
                           @click="emit('displayuserlist', true)">
                Weergeven
            </PrimaryButton>
            <SecondaryButton type="button"
                             class="w-full sm:w-auto"
                             @click="emit('displayuserlist', false)">
                Niet weergeven
            </SecondaryButton>
        </template>
    </Modal>
</template>
