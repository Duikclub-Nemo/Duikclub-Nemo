<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {PencilIcon} from "@heroicons/vue/24/outline/index";
import {useAuthStore} from "@/Stores/authStore.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import SecondaryButton from "@/Components/Forms/SecondaryButton.vue";
import ProfileInformation from "@/Pages/Member/Profile/Partials/ProfileInformation.vue";
import DiveInformation from "@/Pages/Member/Profile/Partials/DiveInformation.vue";
import AboutMeInformation from "@/Pages/Member/Profile/Partials/AboutMeInformation.vue";
import DeleteUserForm from "@/Pages/Member/Profile/Partials/DeleteUserForm.vue";

const props = defineProps({
    user: Object,
})

const auth = useAuthStore()

</script>

<template>
    <Head title="Mijn Profiel"/>
    <PageHeading title="Mijn Profiel">
        Op deze pagina beheer je eenvoudig je persoonlijke gegevens als lid van Duikclub Nemo.
        Het is belangrijk dat je profiel up-to-date is, zodat we je kunnen informeren over trainingen, activiteiten en
        clubzaken.
    </PageHeading>
    <div class="flex flex-col gap-6">
        <Card>
            <template #header>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-900 text-center md:text-left">
                        {{ props.user.fullname }}
                    </h2>
                    <div class="flex gap-2 w-full md:w-auto">
                        <Link v-if="auth.hasPermission('profile.edit')"
                              :href="route('member.profile.edit')"
                              class="w-full">
                            <SecondaryButton class="w-full">
                                <PencilIcon class="size-4 mr-3"/>
                                Wijzig
                            </SecondaryButton>
                        </Link>
                    </div>
                </div>
            </template>
            <ProfileInformation :user="props.user"/>
        </Card>
        <Card v-if="props.user.about_me">
            <AboutMeInformation :about="props.user.about_me"/>
        </Card>
        <Card>
            <DiveInformation :user="props.user"/>
        </Card>
        <Card v-if="auth.hasPermission('profile.delete')">
            <DeleteUserForm/>
        </Card>
    </div>
</template>
