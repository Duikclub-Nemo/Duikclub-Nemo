<script setup>
import DisplayCKEditor from "@/Components/Layout/DisplayCKEditor.vue";

const props = defineProps({
    about: String,
})
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Over mij
            </h2>
        </header>
        <DisplayCKEditor class="mt-2"
                         :text="props.about"/>
    </section>
</template>
