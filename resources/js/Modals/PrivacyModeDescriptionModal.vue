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

const emit = defineEmits(['close', 'privacymode']);

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
                Met het Privacy mode ingeschakeld wordt alleen jouw voornaam voor gasten gebruikt. Bezoekers van de
                website kunnen zowel bij nieuwsberichten als activiteiten alleen jouw voornaam zien.
            </div>
            <div>
                N.B. Ingelogde leden kunnen wel jouw volledige naam zien.
            </div>
        </div>

        <template #footer>
            <PrimaryButton class="w-full sm:w-auto"
                           @click="emit('privacymode', true)">
                Activeren
            </PrimaryButton>
            <SecondaryButton type="button"
                             class="w-full sm:w-auto"
                             @click="emit('privacymode', false)">
                Niet activeren
            </SecondaryButton>
        </template>
    </Modal>
</template>
