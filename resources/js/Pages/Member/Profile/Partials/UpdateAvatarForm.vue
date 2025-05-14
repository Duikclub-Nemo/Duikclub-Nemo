<script setup>
import {useAuthStore} from "@/Stores/authStore.js";
import {defineAsyncComponent, ref} from "vue";
import Avatar from "@/Components/Layout/Avatar.vue";
import {CameraIcon, TrashIcon} from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    user: Object,
})

const auth = useAuthStore()

const isAvatarUploadModal = ref(false)
const isAvatarDeleteModal = ref(false)

const AvatarUploadModal = defineAsyncComponent(() =>
    import('@/Modals/AvatarUploadModal.vue'))
const AvatarDeleteModal = defineAsyncComponent(() =>
    import('@/Modals/AvatarDeleteModal.vue'))
</script>

<template>
    <div class="relative w-fit mx-auto">
        <Avatar class="size-50 md:size-60"
                :url="props.user.avatar"
                :alt="props.user.fullname"/>
        <button v-if="auth.hasPermission('avatar.store')"
                title="Profielfoto uploaden"
                @click="isAvatarUploadModal = true"
                class="absolute left-3 bottom-0 bg-gray-200 hover:bg-gray-300 p-1.5 rounded-full cursor-pointer">
            <CameraIcon class="size-8"/>
        </button>
        <button v-if="props.user.avatar && auth.hasPermission('avatar.delete')"
                title="Profielfoto verwijderen"
                @click="isAvatarDeleteModal = true"
                class="absolute right-3 bottom-0 bg-gray-200 hover:bg-gray-300 p-1.5 rounded-full cursor-pointer">
            <TrashIcon class="size-8"/>
        </button>
    </div>
    <AvatarUploadModal :show="isAvatarUploadModal"
                       :uuid="props.user.uuid"
                       @close="isAvatarUploadModal = false"/>

    <AvatarDeleteModal :show="isAvatarDeleteModal"
                       :uuid="props.user.uuid"
                       @close="isAvatarDeleteModal = false"/>
</template>
