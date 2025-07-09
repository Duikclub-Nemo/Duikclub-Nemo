<script setup>
import {watch} from "vue";
import {usePage} from "@inertiajs/vue3";
import {storeToRefs} from "pinia";
import {useToastStore} from "@/Stores/toastStore.js";
import Toast from "@/Components/Layout/Toast.vue";

const page = usePage()
const toast = useToastStore()

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.message) {
            toast.add({
                type: flash.type,
                message: flash.message,
                duration: flash.duration,
            })
            page.props.flash.message = null;
        }
    },
    {immediate: true}
)
const {items} = storeToRefs(toast)
</script>

<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-40 space-y-2 w-full max-w-xs">
        <Toast v-for="(item, index) in items"
               :key="item.key"
               :type="item.type"
               :message="item.message"
               :duration="item.duration"
               @remove="toast.remove(index)"/>
    </TransitionGroup>
</template>
